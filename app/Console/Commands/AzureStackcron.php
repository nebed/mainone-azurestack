<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Tenant;
use App\Subscription;
use App\Resource;
use App\Alert;
use App\Mail\SendAlert;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AzureStackcron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'azurestack:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron job to pull all customer resources from AzureStack';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tenants = Tenant::all();
        foreach ($tenants as $key => $tenant) {

            //get authentication token

            $access_headers = [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Host' => 'key',
                'return-client-request-id' => 'true',
                'Expect' => '100-continue',
                'Accept' => 'application/json',
            ];
            

            $access_client = new Client([
                // Base URI is used with relative requests
                'headers' => $access_headers,
                'base_uri' => "https://login.microsoftonline.com/".$tenant->tenantid."/oauth2/token",
                // You can set any number of default request options.
            ]);

            $access_response = $access_client->request('POST', '', [
                'form_params' => [
                    'resource' => env('STACK_RESOURCE'),
                    'client_id' => $tenant->client_id,
                    'client_secret' => $tenant->client_secret,
                    'grant_type' => 'client_credentials'
                    ]
            ]);

            //retrieve authentication token

            $auth_token = json_decode($access_response->getBody()->getContents());

            //get tenant subscriptions

            $token_headers = [
            'Authorization' => 'Bearer '.$auth_token->access_token,
            'Accept' => 'application/json',
            ];

            $getsubscriptions_client = new Client([
            'headers' => $token_headers,
            'base_uri' => env('STACK_URL'),
            ]);

            $getsubscriptions_url = env('STACK_URL').'/subscriptions?api-version=2019-06-01';

            $getsubscriptions_response = $getsubscriptions_client->request('GET', $getsubscriptions_url)->getBody();
            $subscription = json_decode((string) $getsubscriptions_response->getContents());

            foreach($subscription->value as $info)
            {
                //store subscriptions 
                $savesubscription = Subscription::updateOrCreate(['subscription_id' => $info->subscriptionId ],
                    ['name' => $info->displayName, 'tenant_id' => $info->tenantId, 'state' => $info->state]
                );
                $savesubscription->touch();

                $getresources_client = new Client([
                'headers' => $token_headers,
                'base_uri' => env('STACK_URL'),
                ]);

                $getresources_url = env('STACK_URL').'/subscriptions/'.$savesubscription->subscription_id.'/resources?api-version=2018-09-01';

                $getresources_response = $getresources_client->request('GET', $getresources_url)->getBody();
                $resources = json_decode((string) $getresources_response->getContents());

                //get further information on resource

                foreach ($resources->value as $resource) {
                    $getresourceinfo_client = new Client([
                        'headers' => $token_headers,
                        'base_uri' => env('STACK_URL'),
                    ]);

                    $getresourceinfo_url = env('STACK_URL').$resource->id.'?api-version=2017-03-30';
                    /** try {

                            $getresourceinfo_response = $getresourceinfo_client->request('GET', $getresourceinfo_url);
                            \Log::info("fetched successfully");

                            // Here the code for successful request

                        } catch (GuzzleHttp\Exception\RequestException $e) {

                            // Catch all 4XX errors 

                            // To catch exactly error 400 use 
                            \Log::info("caught error");
                            if ($e->getResponse()->getStatusCode() == '400') {
                                $getresourceinfo_client = new Client([
                                    'headers' => $token_headers,
                                    'base_uri' => env('STACK_URL'),
                                ]);
                                $getresourceinfo_url = env('STACK_URL').$resource->id.'?api-version=2016-03-30';
                                $getresourceinfo_response = $getresourceinfo_client->request('GET', $getresourceinfo_url);
                            }

                            // You can check for whatever error status code you need 

                        }

                        */

                        try {
                            $getresourceinfo_response = $getresourceinfo_client->request('GET', $getresourceinfo_url);
                            \Log::info("fetched successfully");
                        } catch (\Exception $e ) {
                            \Log::info("caught error");
                            $getresourceinfo_client = new Client([
                                    'headers' => $token_headers,
                                    'base_uri' => env('STACK_URL'),
                                ]);
                                $getresourceinfo_url = env('STACK_URL').$resource->id.'?api-version=2016-03-30';

                                try {

                                    \Log::info("fetched successfully");

                                    $getresourceinfo_response = $getresourceinfo_client->request('GET', $getresourceinfo_url);

                                }catch(\Exception $e ) {

                                    $getresourceinfo_client = new Client([
                                    'headers' => $token_headers,
                                    'base_uri' => env('STACK_URL'),
                                ]);
                                $getresourceinfo_url = env('STACK_URL').$resource->id.'?api-version=2017-10-01';
                                $getresourceinfo_response = $getresourceinfo_client->request('GET', $getresourceinfo_url);

                                }

                        }

                    $resourceinfo = (string) $getresourceinfo_response->getBody()->getContents();

                    

                    $checkresource = Resource::where('url',$resource->id)->first();
                    if($checkresource) {
                        if( json_decode($checkresource->details) != json_decode($resourceinfo) ){
                            //changed resource
                            \Log::info("Created Changed alert");
                            $alert = new Alert;
                            $alert->type='Changed Resource'; $alert->resource_name = $resource->name; $alert->resource_id = $resource->id; $alert->resource_type = $resource->type; $alert->resource_state = false; $alert->resource_details = $resourceinfo; $alert->old_resource_details = $checkresource->details; $alert->tenant_id = $info->tenantId;
                            $alert->save();
                            \Mail::to('uchenna.nebedum@mainone.net')->send(new SendAlert($alert));
                            $alert->sent = true;
                            $alert->save();
                            $checkresource->compliant = false;
                            $checkresource->details = $resourceinfo;
                            $checkresource->save(); 
                        }
                    }else {
                        //new resource
                        \Log::info("Created New alert");
                        $alert = new Alert;
                            $alert->type='New Resource'; $alert->resource_name = $resource->name; $alert->resource_id = $resource->id; $alert->resource_type = $resource->type; $alert->resource_state = false; $alert->resource_details = $resourceinfo; $alert->old_resource_details = "{}"; $alert->tenant_id = $info->tenantId;
                            $alert->save();
                        \Mail::to('uchenna.nebedum@mainone.net')->send(new SendAlert($alert));
                        $alert->sent = true;
                        $alert->save();

                    }
                    //store resource
                    $saveresource = Resource::updateOrCreate([ 'url' => $resource->id ],
                        ['name' => $resource->name, 'type' => $resource->type, 'details' => $resourceinfo, 'subscription_id' => $savesubscription->subscription_id, 'tenant_id'=> $savesubscription->tenant_id]
                    );
                    $saveresource->touch();

                }

                \Log::info("completed successfully");

            }
        }
    }
}
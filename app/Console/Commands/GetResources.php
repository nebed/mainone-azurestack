<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
Use App\Tenant;
use App\Subscription;
use App\VirtualMachine;
use App\ResourceParser;
use GuzzleHttp\Client;

class GetResources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:getresources';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Resources from all customer environments by resource type';

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
                    if ($resource->type == 'Microsoft.Compute/virtualMachines')
                    {
                        $getresourceinfo_client = new Client([
                            'headers' => $token_headers,
                            'base_uri' => env('STACK_URL'),
                        ]);
 
                        $getresourceinfo_url = env('STACK_URL').$resource->id.'?api-version=2017-03-30';
                        $getresourceinfo_response = $getresourceinfo_client->request('GET', $getresourceinfo_url);
                        $resourceinfo = (string) $getresourceinfo_response->getBody()->getContents();
                        $vmdetails  = new ResourceParser;
                        $vmdata = $vmdetails->parse('Microsoft.Compute/virtualMachines',$resourceinfo);
                        $virtualmachine = VirtualMachine::updateOrCreate([ 'vm_id' => $resource->id ],
                        ['name' => $resource->name, 'tenant_id'=>$tenant->tenantid, 'os_type' => $vmdata['os_type'], 'state' => $vmdata['state'], 'vmsize' => $vmdata['vmsize'], 'subscription_id'=> $savesubscription->subscription_id]
                        );
                        $virtualmachine->touch();

                    }
                }

            }

        }
    }
}

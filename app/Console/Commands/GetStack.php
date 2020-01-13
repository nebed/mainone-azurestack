<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use App\Endpoint;

class GetStack extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:stack';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $endpoint = new Endpoint;

        //get azurestack health data
        $health_data = $endpoint->get_health();
        $actual_health_data = $health_data->properties->usageMetrics;

        //variable to store azurestack health data
        $stackinfo = [];

        //loop through health data and create database entries
        foreach($actual_health_data as $data)
        {
            $entry = ['name'=>$data->name,'available'=>$data->metricsValue[1]->value,'used'=>$data->metricsValue[0]->value,'unit'=>$data->metricsValue[0]->unit];
            array_push($stackinfo,$entry);
        }

        //update or Store each data
        foreach ($stackinfo as $data) 
        {
            $this->modelCreateOrUpdate('Stackinfo',$data,['name'=>$data['name']]);
        }

        //get azurestack alert data
        $stackalert_data = $endpoint->get_stackalerts();
        $stackalerts = [];

        //loop through alert data and create databse entries
        foreach($stackalert_data->value as $data)
        {
            $properties = $data->properties;
            $entry = ['alertid'=>$properties->alertId, 'title'=>$properties->title, 'description'=>implode(' ',Arr::flatten((array)$properties->description[0])), 'faulttype'=>$properties->faultTypeId, 'impactedresource'=>$properties->impactedResourceDisplayName, 'severity'=>$properties->severity, 'state'=>$properties->state, 'remediation'=>implode(' ',Arr::flatten((array)$properties->remediation[0])), 'createdtimestamp'=>$properties->createdTimestamp];
            array_push($stackalerts, $entry);
        }

        foreach ($stackalerts as $data) 
        {
            $this->modelCreateOrUpdate('Stackalert',$data,['alertid'=>$data['alertid']]);
        }

        //get azurestack tenants and subscriptions
        $tenant_data = $endpoint->get_tenants();
        $actual_tenant_data = collect($tenant_data->value)->groupBy('tenantId');

        //loop through tenants and store subscriptions
        foreach ($actual_tenant_data as $tenantid => $subscriptions) 
        {
            $partner_centerdata = $endpoint->get_tenantname($tenantid);
            preg_match('/(?<=companyName":")(.*?)(?=","links")/', $partner_centerdata ,$names);
            preg_match('/(?<=email":")(.*?)(?=","culture)/', $partner_centerdata,$email);
            $tenantname = $names[0];
            $tenantemail = $email[0];
            $entry = ['tenantid'=>$tenantid,'name'=>$tenantname,'contact_email'=>$tenantemail];

            $this->modelCreateOrUpdate('Tenant', $entry, ['tenantid'=>$tenantid]);

            foreach ($subscriptions as $subscription) 
            {
                $subentry = ['subscriptionid'=>$subscription->subscriptionId,'name'=>$subscription->displayName,'tenantid'=>$subscription->tenantId,'state'=>$subscription->state,'owner'=>$subscription->owner,'offer'=>$subscription->offerId];
                $this->modelCreateOrUpdate('Subscription',$subentry,['subscriptionid'=>$subscription->subscriptionId]);

                $quotas = $endpoint->get_quotas($subscription->offerId,$subscription->subscriptionId,$subscription->tenantId);
                $this->modelCreateOrUpdate('Computequota',$quotas['compute_quota'],['subscriptionid'=>$subscription->subscriptionId]);
                $this->modelCreateOrUpdate('Networkquota',$quotas['network_quota'],['subscriptionid'=>$subscription->subscriptionId]);
                $this->modelCreateOrUpdate('Storagequota',$quotas['storage_quota'],['subscriptionid'=>$subscription->subscriptionId]);

            }

        }

        $this->delete_old_data();

        
    }


    public function modelCreateOrUpdate($modelname,$data,$column_to_match)
    {
        //Capitalize first letter of $modelname
        $modelname = ucfirst($modelname);

        $r = new \ReflectionClass('App\\'.$modelname);

        // @param ClassPeer $instance

        $modelinstance =  $r->newInstanceWithoutConstructor();

        //dynamically call the Model class using $modelname param
        $model_data = $modelinstance->updateOrCreate($column_to_match,$data);

        //change updated_at column even if data was not updated to show it still exists
        $model_data->touch();

        //\Log::info(print_r($model_data, true));

    }

    public function delete_old_data()
    {
        \App\Subscription::whereRaw('updated_at <= now() - interval 2 hour')->delete();
        \App\Tenant::whereRaw('updated_at <= now() - interval 2 hour')->delete();
        \App\Networkquota::whereRaw('updated_at <= now() - interval 2 hour')->delete();
        \App\Computequota::whereRaw('updated_at <= now() - interval 2 hour')->delete();
        \App\Storagequota::whereRaw('updated_at <= now() - interval 2 hour')->delete();

    }
    
}

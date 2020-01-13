<?php

namespace App;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class Endpoint
{

	const TOKEN_REQUEST_HEADERS = [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Host' => 'key',
                'return-client-request-id' => 'true',
                'Expect' => '100-continue',
                'Accept' => 'application/json',
            ];


    public $client_id = '';

    public $client_secret = '';

    public $tenant_id = '';

    public $resource = '';

    public $provider_subscription_id = '';

    public $token=null;


	public function __construct()
    {
            $this->client_id = env('AZURESTACK_ADMIN_CLIENT_ID');

		    $this->client_secret = env('AZURESTACK_ADMIN_CLIENT_SECRET');

		    $this->tenant_id = env('AZURESTACK_TENANT_ID');

		    $this->resource = env('AZURESTACK_ADMIN_RESOURCE');

		    $this->provider_subscription_id = env('DEFAULT_PROVIDER_SUBSCRIPTION_ID');
    }

    public function generate_token()
    {
    	if($this->has_token_expired())
    	{
    		$base_uri = "https://login.microsoftonline.com/".$this->tenant_id."/oauth2/token";

    	//create request client
    	$generate_token_client = new Client([
    		'headers' => self::TOKEN_REQUEST_HEADERS,
    		'base_uri' => $base_uri,
    	]);

    	//make request for token with params
    	$generate_token_response = $generate_token_client->request('POST', '', [
    		'form_params' => [
    			'resource' => $this->resource,
    			'client_id' => $this->client_id,
    			'client_secret' => $this->client_secret,
    			'grant_type' => 'client_credentials'
    		]
    	]);

    	//get timestamp to add token to track expiry
    	$date = time();

    	//convert response to php object
    	$auth_token = json_decode($generate_token_response->getBody()->getContents());

    	$this->token = ['created_at'=>$date, 'token'=>$auth_token->access_token];

    	//return auth_token with timestamp
    	return; 

    	}
    	else
    	{
    		return;
    	}
    }

    //get tenants from azurestack admin endpoint

    public function get_tenants()
    {
    	$get_tenant_url = env('AZURESTACK_ADMIN_URL').'/subscriptions/'.env('DEFAULT_PROVIDER_SUBSCRIPTION_ID').'/providers/Microsoft.Subscriptions.Admin/subscriptions';
    	$api_version = '2015-11-01';
    	$tenant_data = $this->make_request($get_tenant_url,$api_version);
    	return $tenant_data;

    }

    public function get_quotas($offer,$subscriptionId,$tenantId)
    {
        $get_offer_url = env('AZURESTACK_ADMIN_URL').$offer;
        $api_version='2015-11-01';

        //get all associated plans
        $plans = $this->get_plans($get_offer_url,$api_version);
        $quota_ids = [];
        $storage_quota = ['storageaccounts' => 0,'capacity' => 0, 'subscriptionid' => $subscriptionId];
        $network_quota = ['publicip'=>0,'vnets'=>0,'virtual_gateway'=>0,'tunnels'=>0,'loadbalancers'=>0,'nics'=>0,'nsgs'=>0,'subscriptionid' => $subscriptionId];
        $compute_quota = ['vmcount'=>0,'corelimit'=>0,'availabilityset'=>0,'vmscaleset'=>0,'subscriptionid' => $subscriptionId];
        foreach($plans as $plan)
        {
            $getquota_url = env('AZURESTACK_ADMIN_URL').$plan;
            $api_version = '2015-11-01';
            $quotaids = $this->get_quota_url($getquota_url,$api_version);
            array_push($quota_ids,$quotaids);

        }
        $quota_urls  = Arr::flatten($quota_ids);

        foreach($quota_urls as $url)
        {
            if(strpos($url, 'Microsoft.Storage.Admin') !== false)
            {
                $get_storage_quota = env('AZURESTACK_ADMIN_URL').$url;
                $api_version='2015-12-01-preview';
                $storage_quota_data = $this->make_request($get_storage_quota,$api_version);
                $storage_quota['storageaccounts'] += $storage_quota_data->properties->numberOfStorageAccounts;
                $storage_quota['capacity'] += $storage_quota_data->properties->capacityInGb;
                

            }elseif (strpos($url, 'Microsoft.Network.Admin') !== false) 
            {
                $get_network_quota = env('AZURESTACK_ADMIN_URL').$url;
                $api_version='2015-06-15';
                $network_quota_data = $this->make_request($get_network_quota,$api_version);
                $network_quota['publicip'] += $network_quota_data->properties->maxPublicIpsPerSubscription;
                $network_quota['vnets'] += $network_quota_data->properties->maxVnetsPerSubscription;
                $network_quota['virtual_gateway'] += $network_quota_data->properties->maxVirtualNetworkGatewaysPerSubscription;
                $network_quota['tunnels'] += $network_quota_data->properties->maxVirtualNetworkGatewayConnectionsPerSubscription;
                $network_quota['loadbalancers'] += $network_quota_data->properties->maxLoadBalancersPerSubscription;
                $network_quota['nics'] += $network_quota_data->properties->maxNicsPerSubscription;
                $network_quota['nsgs'] += $network_quota_data->properties->maxSecurityGroupsPerSubscription;

            }elseif (strpos($url, 'Microsoft.Compute.Admin') !== false) 
            {
                $get_compute_quota = env('AZURESTACK_ADMIN_URL').$url;
                $api_version = '2015-12-01-preview';
                $compute_quota_data = $this->make_request($get_compute_quota,$api_version);
                $compute_quota['vmcount'] += $compute_quota_data->properties->virtualMachineCount;
                $compute_quota['corelimit'] += $compute_quota_data->properties->coresLimit;
                $compute_quota['availabilityset'] += $compute_quota_data->properties->availabilitySetCount;
                $compute_quota['vmscaleset'] += $compute_quota_data->properties->vmScaleSetCount;

            }/**elseif (strpos($url, 'Microsoft.KeyVault.Admin') !== false) 
            {
                $get_keyvault_quota = env('AZURESTACK_ADMIN_URL').$url;
                $api_version = '2017-02-01-preview';
                $keyvault_quota_data = $this->make_request($get_keyvault_quota,$api_version);
                $keyvault_quota = [];
                //to be completed create table and model
            }*/
        }

        $result = ['compute_quota' => $compute_quota,'network_quota' => $network_quota, 'storage_quota'=> $storage_quota, 'plans' => $plans];

        return $result;

    }

    public function get_quota_url($url,$api_version)
    {
        $quota_url_data = $this->make_request($url,$api_version);

        return Arr::flatten($quota_url_data->properties->quotaIds);

    }

    public function get_plans($url,$api_version)
    {
        $offer_data = $this->make_request($url,$api_version);
        $plans = [];
        array_push($plans,$offer_data->properties->basePlanIds);
        foreach($offer_data->properties->addonPlans as $addonplans)
        {
            array_push($plans,$addonplans->planId);
        }
        return Arr::flatten($plans);
    }

    public function get_health()
    {
    	$get_health_url = env('AZURESTACK_ADMIN_URL').'/subscriptions/'.env('DEFAULT_PROVIDER_SUBSCRIPTION_ID').'/resourceGroups/system.ng/providers/Microsoft.InfrastructureInsights.Admin/regionHealths/ng';
    	$api_version='2016-05-01';
    	$health_data = $this->make_request($get_health_url,$api_version);
    	return $health_data;
    }

    public function get_stackalerts()
    {
    	$get_stackalerts_url = env('AZURESTACK_ADMIN_URL').'/subscriptions/'.env('DEFAULT_PROVIDER_SUBSCRIPTION_ID').'/resourceGroups/system.ng/providers/Microsoft.InfrastructureInsights.Admin/regionHealths/ng/alerts';
    	$api_version = '2016-05-01';
    	$stackalert_data = $this->make_request($get_stackalerts_url,$api_version);
    	return $stackalert_data;
    }

    public function get_tenantname($tenantid)
    {
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
		    'base_uri' => env('GENERATE_PARTNER_TOKEN'),
		    // You can set any number of default request options.
		]);

    	$access_response = $access_client->request('POST', '', [
		    'form_params' => [
		        'resource' => 'https://graph.windows.net',
		        'client_id' => env('PARTNER_CENTER_CLIENT_ID'),
		        'client_secret' => env('PARTNER_CENTER_CLIENT_SECRET'),
		        'grant_type' => 'client_credentials'
		        ]
		]);

		$data = json_decode($access_response->getBody()->getContents());

		$request_headers = [
			'Authorization' => 'Bearer '.$data->access_token,
			'Accept' => 'application/json',
		];

		$request_client = new Client([
			'headers' => $request_headers,
			'base_uri' => env('PARTNER_CENTER_ENDPOINT'),
		]);

		$url = env('PARTNER_CENTER_ENDPOINT').'/v1/customers/'.$tenantid;

		$request_response = $request_client->request('GET', $url)->getBody();

		return strval($request_response->getContents());
    }


    //check if token exists or has expired and return true or false
    public function has_token_expired()
    {
    	if(is_null($this->token))
    	{
    		return true;
    	}
    	elseif(time() - $this->token['created_at'] > 3000)
    	{
    		return true;
    	}
    	return false;
    }

    public function get_usage($subscriberId='')
    {
        //get billing period start and end day
        $billingperiod =  \DB::table('billingperiod')->first();

        $startday = $billingperiod->startday;
        $endday = $billingperiod->endday;

        if(today()->format('d') >= $startday)
        {
            $endmonth = today()->startOfMonth()->addMonths(1)->format('m');
            $startmonth = today()->format('m');
            $startyear = today()->format('Y');
            $endyear = today()->startOfMonth()->addMonths(1)->format('Y');
        }
        else
        {
            $startmonth = today()->startOfMonth()->subMonth()->format('m');
            $startyear = today()->startOfMonth()->subMonth()->format('Y');
            $endmonth = today()->format('m');
            $endyear = today()->format('Y');   
        }

        $startdate = $startyear.'-'.$startmonth.'-'.$startday.'T00:00:00.000Z';
        $enddate = $endyear.'-'.$endmonth.'-'.$endday.'T00:00:00.000Z';
        
        $get_usage_url = env('AZURESTACK_ADMIN_URL').'/subscriptions/'.env('DEFAULT_PROVIDER_SUBSCRIPTION_ID').'/providers/Microsoft.Commerce.Admin/subscriberUsageAggregates';
        $params = ['reportedStartTime'=>$startdate,
                    'reportedEndTime'=>$enddate,
                    'aggregationGranularity'=>'daily',
                    'subscriberId'=>$subscriberId];
        $api_version = '2015-06-01-preview';

        $usage_data = $this->make_request($get_usage_url,$api_version,$params);

        $continue = true;

        while ( $continue ) 
        {
            if (!isset($usage_data->nextLink))
            {
                $continue = false;
                break;
            } else 
            {

                $more_data = $this->make_request($usage_data->nextLink);

                $usage_data->value = array_merge($usage_data->value,$more_data->value);

                if(!isset($more_data->nextLink))
                {
                    unset($usage_data->nextLink);
                }else
                {
                    $usage_data->nextLink = $more_data->nextLink;
                }
            }
            
        }

        collect($usage_data->value)->map(function($item){
            preg_match('/(\w+(?:\-\w+)?)$/', json_decode($item->properties->instanceData)->{'Microsoft.Resources'}->resourceUri,$matches);
            $item->meterId = strtolower($item->properties->meterId);
            $item->quantity = $item->properties->quantity; //can be exponential
            $item->subscriptionId = strtolower($item->properties->subscriptionId);
            $item->resourcename = $matches[0];
            $item->instanceData = json_decode($item->properties->instanceData)->{'Microsoft.Resources'};
            $item->additionalInfo = json_decode($item->instanceData->additionalInfo);
            unset($item->properties);
            unset($item->instanceData);
        })->all();

        $meterusage = collect($usage_data->value);

        return [$startyear.'-'.$startmonth.'-'.$startday.'_'.$endyear.'-'.$endmonth.'-'.$endday,$meterusage];

    }

    public function make_request($endpoint,$api_version='',$params = [])
    {
    	//call token genration function
    	$this->generate_token();
        if($api_version != '')
        {
            $params['api-version'] = $api_version;
        }

    	//create request headers
    	$authorization_headers = [
            'Authorization' => 'Bearer '.$this->token['token'],
            'Accept' => 'application/json',
            ];

        $request_client = new Client([
        	'headers' => $authorization_headers,
        ]);

        if($params == [])
        {
            $request_response = $request_client->request('GET',$endpoint)->getBody();
        }else
        {
            $request_response = $request_client->request('GET',$endpoint,['query' => $params])->getBody();
        }

        //make request
        $request_data = json_decode((string) $request_response->getContents());

        return $request_data;
    }

}

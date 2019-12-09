<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Tenant;
use GuzzleHttp\Client;

class UsageController extends Controller
{
    public function index(Request $request, $tenantid)
    {
    	$tenant = Tenant::where('tenantid', $tenantid)->first();

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
            'base_uri' => "https://login.microsoftonline.com/".$tenantid."/oauth2/token",
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

        $token_headers = [
	        'Authorization' => 'Bearer '.$auth_token->access_token,
	        'Accept' => 'application/json',
	        ];

        $subscriptions = $tenant->subscriptions;

        foreach( $subscriptions as $subscription)
        {
        	//$nextlink = false:
        	$getusage_client = new Client([
	            'headers' => $token_headers,
	            'base_uri' => env('STACK_URL'),
	        ]);

            $getusage_url = env('STACK_URL').'/subscriptions/'.$subscription->subscription_id.'/providers/Microsoft.Commerce/usageAggregates';

            $getusage_data = $getusage_client->request('GET', $getusage_url, 
            	['query' => ['aggregationGranularity' => 'daily', 'reportedStartTime' => $request->start_date, 'reportedEndTime' => $request->end_date, 'api-version' => '2015-06-01-preview']
            ])->getBody();

            $usage_data = json_decode((string) $getusage_data->getContents());

            //$usage_data = $usage_response;


            /**if(array_key_exists('nextLink', $usage_data)){
            	$nextlink = true;
            }

            while($nextlink){
            	$getnext_client = new Client([
		            'headers' => $token_headers,
		            'base_uri' => env('STACK_URL'),
		        ]);

		        $getnext_response = $getnext_client->request('GET', $usage_response->nextLink)->getBody();

		        $usage_data = json_decode((string) $getusage_response->getContents());


            }**/

            /**return response()->json([
	            'status' => 'success',
	            'data' => $usage_data
	        ], 200);**/

            $sorted = collect($usage_data->value)->groupBy(function($item, $key) {
				        return $item->properties->meterId;
				    });

            $grouped = [];
            $final = [];
            foreach ($sorted as $meterId => $value) {
				 $grouped[$meterId] = $value->groupBy(function($item, $key) {
					        return $item->properties->instanceData;
					    });
			}

			foreach ($grouped as $meterId => $value) {
				$final[$meterId] = [];
				foreach($value as $instanceData => $value1) {
					$array = json_decode((string) $instanceData,true);
					preg_match('/(\w+(?:\-\w+)?)$/', $array['Microsoft.Resources']['resourceUri'],$matches);
					//$final[$meterId][$matches[0]] = $value1->sum(function($item){
					//	return $item->properties->quantity;
					//});
					$grouped[$meterId][$instanceData] = $value1->sum(function($item){
						return $item->properties->quantity;
					});
					$new_array = ['name'=> $matches[0],'usage'=> $grouped[$meterId][$instanceData], 'info'=> $array['Microsoft.Resources']['additionalInfo']];
					array_push($final[$meterId],$new_array);
				}
			}
            
            return response()->json([
	            'status' => 'success',
	            'data' => $final
	        ], 200);

        } 
    }

    public function group_by($key, $data) 
    {
	    $result = array();

	    foreach($data as $val) {
	        if(array_key_exists($key, $val)){
	            $result[$val[$key]][] = $val;
	        }else{
	            $result[""][] = $val;
	        }
	    }

	    return $result;
	}
}

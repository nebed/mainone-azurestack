<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Tenant;
use Validator;

class TenantController extends Controller
{
    
	public function index()
	{
		$tenants = Tenant::withCount(['resources' => function ($query) {
					$query->where('compliant', false);
				}])->orderBy('created_at', 'desc')->get();

		return response()->json([
			'status' => 'success',
			'data' => $tenants
		], 200);
	}

    public function getId(Request $request)
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

		$url = env('PARTNER_CENTER_ENDPOINT').'/v1/customers/'.$request->tenantid;

		//dd($url);

		$request_response = $request_client->request('GET', $url)->getBody()->getContents();

		return $request_response;

		//dd(json_decode($request_response->getBody()->getContents()));

		//$customer_data = json_decode($request_response->getBody()->getContents());

		//$customer_data = iconv("ISO-8859-1","UTF-8",$customer_data);

		//$customer_data = json_decode($request_response);

		

		//return response()->json(['data' => $response->getBody()->getContents()], 200);


    }

    public function store(Request $request) {
    	$v = Validator::make($request->all(), [
            'tenantid' => 'required|unique:tenants',
            'name'  => 'required|string',
            'mrc'  => 'required',
            'client_id' => 'required|string',
            'client_secret' => 'required|string'
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        else {
        	$tenant = new Tenant;
        	$tenant->tenantid = $request->tenantid;
        	$tenant->name = $request->name;
        	$tenant->mrc = $request->mrc;
        	$tenant->client_id = $request->client_id;
        	$tenant->client_secret = $request->client_secret;
        	$tenant->save();
        	return response()->json([
        		'status' => 'success',
        		'message' => 'tenant saved successfully'
        	], 200);
        }
    }
}

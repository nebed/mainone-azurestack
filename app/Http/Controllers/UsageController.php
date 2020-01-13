<?php

namespace App\Http\Controllers;

use App\Usage;
use App\Endpoint;
use Illuminate\Http\Request;

class UsageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getCurrentBill($subscriberId)
    {
        $usearray = [];
        $endpoint = new Endpoint;
        $usage_result = $endpoint->get_usage($subscriberId);
        $billing_period = $usage_result[0];
        $usage_data = $usage_result[1]->groupBy(['meterId','resourcename']);

        $new = $usage_data->map(function($item,$key){
            return $item->map(function($new,$index){
                if($new->flatten()[0]->meterId == '6dab500f-a4fd-49c4-956d-229bb9c8c793'){
                    $name = $new->flatten()[0]->additionalInfo->ServiceType;
                }
                else{
                    $name = \App\Rate::where('meterid',$new->flatten()[0]->meterId)->first()->name;
                }
               return ['name'=>$name,'usage'=>$new->flatten()->sum('quantity')];
            });
        })->all();

        foreach ($new as $meterId => $resource) {
            foreach ($resource as $resourcename => $data) {
                array_push($usearray,['name'=>$data['name'],'resourcename'=>$resourcename,'usage'=>$data['usage'],'meterid'=>$meterId]);
            }
        }

        return $usearray; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usage  $usage
     * @return \Illuminate\Http\Response
     */
    public function show(Usage $usage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usage  $usage
     * @return \Illuminate\Http\Response
     */
    public function edit(Usage $usage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usage  $usage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usage $usage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usage  $usage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usage $usage)
    {
        //
    }
}

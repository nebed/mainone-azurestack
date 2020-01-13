<?php

namespace App\Http\Controllers;

use App\Stackinfo;
use App\Tenant;
use App\Subscription;
use App\Stackalert;
use Illuminate\Http\Request;

class StackinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stackinfo = Stackinfo::all();
        $usedmemory = $stackinfo[0]->used;
        $availablememory = $stackinfo[0]->available;
        $usedstorage = $stackinfo[1]->used;
        $availablestorage = $stackinfo[1]->available;
        $usedips = $stackinfo[2]->used;
        $availableips = $stackinfo[2]->available;
        $criticalalerts = Stackalert::where('state','Active')->where('severity','Critical')->count();
        $warningalerts = Stackalert::where('state','Active')->where('severity','Warning')->count();
        $tenants = Tenant::orderBy('updated_at')->count();
        $subscriptions = Subscription::orderBy('updated_at')->count();
        $data = [
            ['title1'=>'Used Memory | GB','data1'=>round($usedmemory,2),'title2'=>'Available Memory | GB','data2'=>round($availablememory,2),'icon'=>'fas fa-microchip fa-4x'],
            ['title1'=>'Used Storage | TB','data1'=>round($usedstorage,2),'title2'=>'Available Storage | TB','data2'=>round($availablestorage,2), 'icon'=>'fas fa-hdd fa-4x'],
            ['title1'=>'Used Public IPs','data1'=>$usedips,'title2'=>'Available Public Ips','data2'=>$availableips, 'icon'=>'fas fa-globe-africa fa-4x'],
            ['title1'=>'Critical Alerts','data1'=>$criticalalerts,'title2'=>'Warning Alerts','data2'=>$warningalerts,'icon'=>'fas fa-exclamation-circle fa-4x']
        ];
        $tenantdata = [
            ['name'=>'Tenants','value'=>$tenants,'icon'=>'fas fa-user-tag fa-4x'],
            ['name'=>'Subscriptions','value'=>$subscriptions,'icon'=>'fas fa-money-bill-alt fa-4x']
        ];

        return [$data,$tenantdata];
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
     * @param  \App\Stackinfo  $stackinfo
     * @return \Illuminate\Http\Response
     */
    public function show(Stackinfo $stackinfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stackinfo  $stackinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(Stackinfo $stackinfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stackinfo  $stackinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stackinfo $stackinfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stackinfo  $stackinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stackinfo $stackinfo)
    {
        //
    }
}

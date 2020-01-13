<?php

namespace App\Http\Controllers;

use App\Tenant;
use Illuminate\Http\Request;
use App\Rate;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = Tenant::withCount('subscriptions')->get();

        return $tenants;
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
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function show($tenantid)
    {
        $billing_period = $this->currentBillingPeriod();
        $tenant = Tenant::where('tenantid',$tenantid)->withCount('subscriptions')->first();
        $subscriptions = $tenant->subscriptions()->with(['computequotas', 'storagequotas','networkquotas','usage' => function($q) use($billing_period) {
            $q->where('billing_period', $billing_period);
        }])->get();
        $rates = Rate::all()->keyBy('name');
        return [$tenant,$subscriptions,$rates];


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        //
    }

    public function currentBillingPeriod()
    {
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

        return $startyear.'-'.$startmonth.'-'.$startday.'_'.$endyear.'-'.$endmonth.'-'.$endday ; 
    }
}

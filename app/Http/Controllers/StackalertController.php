<?php

namespace App\Http\Controllers;

use App\Stackalert;
use Illuminate\Http\Request;

class StackalertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alerts = Stackalert::orderBy('created_at','desc')->get();
        $criticalalerts = Stackalert::where('state','Active')->where('severity','Critical')->count();
        $warningalerts = Stackalert::where('state','Active')->where('severity','Warning')->count();
        $closedalerts = Stackalert::where('state','Closed')->count();

        return ['alerts'=>$alerts,'critical'=>$criticalalerts,'warning'=>$warningalerts,'closed'=>$closedalerts];
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
     * @param  \App\Stackalert  $stackalert
     * @return \Illuminate\Http\Response
     */
    public function show(Stackalert $stackalert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stackalert  $stackalert
     * @return \Illuminate\Http\Response
     */
    public function edit(Stackalert $stackalert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stackalert  $stackalert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stackalert $stackalert)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stackalert  $stackalert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stackalert $stackalert)
    {
        //
    }
}

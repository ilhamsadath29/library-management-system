<?php

namespace App\Http\Controllers;

use App\Models\RackLocation;
use App\Http\Requests\StoreRackLocationRequest;
use App\Http\Requests\UpdateRackLocationRequest;

class RackLocationController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRackLocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRackLocationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RackLocation  $rackLocation
     * @return \Illuminate\Http\Response
     */
    public function show(RackLocation $rackLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRackLocationRequest  $request
     * @param  \App\Models\RackLocation  $rackLocation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRackLocationRequest $request, RackLocation $rackLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RackLocation  $rackLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(RackLocation $rackLocation)
    {
        //
    }
}

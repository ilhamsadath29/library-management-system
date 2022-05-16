<?php

namespace App\Http\Controllers;

use App\Models\SiteUser;
use Illuminate\Http\Request;
use App\Models\RackLocation;
use App\Http\Resources\RackResource;
use App\Http\Requests\StoreRackLocationRequest;
use App\Http\Requests\UpdateRackLocationRequest;

class RackLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        
        $siteUser = SiteUser::where('user_id', $user->id)->first();
        if (empty($siteUser)) {
            return response([
                'message' => 'The provided credentials are not correct'
            ], 422);
        }

        return RackResource::collection(RackLocation::where('site_id', $siteUser->setting_id)->where('status', '!=', 9)->paginate(6));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRackLocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRackLocationRequest $request)
    {
        $data = $request->validated();

        $result = RackLocation::create($data);

        return new RackResource($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RackLocation  $rackLocation
     * @return \Illuminate\Http\Response
     */
    public function show(RackLocation  $rack)
    {
        return new RackResource($rack);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRackLocationRequest  $request
     * @param  \App\Models\RackLocation  $rackLocation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRackLocationRequest $request, RackLocation  $rack)
    {
        $data = $request->validated();

        $rack->update($data);

        return new RackResource($rack);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RackLocation  $rackLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(RackLocation $rack)
    {
        $rack->status = 9;
        $rack->name = $this->currentTimestamp().'_'.$rack->name;
        $rack->update();

        return response('', 204);
    }
}

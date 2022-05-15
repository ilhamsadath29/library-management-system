<?php

namespace App\Http\Controllers;

use App\Models\RackLocation;
use App\Http\Requests\StoreRackLocationRequest;
use App\Http\Requests\UpdateRackLocationRequest;
use App\Http\Resources\RackResource;
use App\Models\SiteUser;
use Illuminate\Http\Request;

class RackLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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

        return RackResource::collection(RackLocation::where('site_id', $siteUser->setting_id)->paginate(6));
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
    public function show($id)
    {
        $rackLocation = RackLocation::where('id', $id)->first();
        return new RackResource($rackLocation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRackLocationRequest  $request
     * @param  \App\Models\RackLocation  $rackLocation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRackLocationRequest $request, $id)
    {
        $data = $request->validated();
        $rackLocation = RackLocation::where('id', $id)->first();

        // Update survey
        $rackLocation->update($data);

        return new RackResource($rackLocation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RackLocation  $rackLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(RackLocation $rackLocation)
    {
        $rackLocation->status = 9;
        $rackLocation->name = $this->currentTimestamp().'_'.$rackLocation->name;
        $rackLocation->update();

        return response('', 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\SiteUserResource;
use App\Models\SiteUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Password;

class SiteUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($site_id, Request $request)
    {
        return SiteUserResource::collection(
            SiteUser::where('setting_id', $site_id)
                ->where('status', '!=', 9)
                ->with(['user'])
                ->paginate(6)
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($site_id, Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string',
            'address'   => 'nullable|string',
            'contact'   => 'nullable|string',
            'profile'   => 'nullable|string',
            'email'     => 'required|email|string|unique:users,email',
            'password'  => [
                'required',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'address'  => $data['address'],
            'contact'  => $data['contact'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'type'     => 1
        ]);

        $siteUser = SiteUser::updateOrCreate(
            ['setting_id' =>$site_id, 'user_id' => $user->id],
            ['setting_id' =>$site_id, 'user_id' => $user->id, 'status' => isset($request->status) ? $request->status : 1]
        );

        $siteUser->user = $user;

        return new SiteUserResource($siteUser);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($site_id, $id)
    {
        return new SiteUserResource(
            SiteUser::where('setting_id', $site_id)
                ->where('user_id', $id)
                ->where('status', '!=', 9)
                ->with(['user'])
                ->first()
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $site_id, $id)
    {
        $data = $request->validate([
            'name'      => 'required|string',
            'address'   => 'nullable|string',
            'contact'   => 'nullable|string',
            'profile'   => 'nullable|string',
        ]);

        $updateData = [
            'name'     => $data['name'],
            'address'  => $data['address'],
            'contact'  => $data['contact'],
            'type'     => 1
        ];

        if (isset($request->password)) {
            $data = $request->validate([
                'password'  => [
                    'required',
                    Password::min(8)->mixedCase()->numbers()->symbols()
                ],
            ]);

            $updateData['password'] = bcrypt($data['password']);
        }
        
        $user = User::where('id', $id)->update($updateData);


        $siteUser = SiteUser::updateOrCreate(
            ['setting_id' => $site_id, 'user_id' => $id],
            ['setting_id' => $site_id, 'user_id' => $id, 'status' => isset($request->status) ? $request->status : 1]
        );

        $siteUser->user = $user;

        return response([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($site_id, $id)
    {
        SiteUser::where('setting_id', $site_id)->where('user_id', $id)->delete();
        $user = User::where('id', $id)->first();

        // image delete
        if ($user->profile) {
            $absolutePath = public_path($user->profile);
            File::delete($absolutePath);
        }

        $user->delete();

        $user = Auth::user();

        if ($user->id === $id) {
            $user->currentAccessToken()->delete();
        }

        return response([
            'success' => true
        ]);
    }
}

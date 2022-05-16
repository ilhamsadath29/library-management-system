<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\SiteUser;
use Illuminate\Http\Request;
use App\Http\Resources\AuthorResource;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

class AuthorController extends Controller
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

        return AuthorResource::collection(Author::where('site_id', $siteUser->setting_id)->where('status', '!=', 9)->paginate(6));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAuthorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuthorRequest $request)
    {
        $data = $request->validated();

        $result = Author::create($data);

        return new AuthorResource($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return new AuthorResource($author);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAuthorRequest  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $data = $request->validated();

        $author->update($data);

        return new AuthorResource($author);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->status = 9;
        $author->name = $this->currentTimestamp().'_'.$author->name;
        $author->update();

        return response('', 204);
    }
}

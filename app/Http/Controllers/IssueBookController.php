<?php

namespace App\Http\Controllers;

use App\Models\IssueBook;
use App\Http\Requests\StoreIssueBookRequest;
use App\Http\Requests\UpdateIssueBookRequest;

class IssueBookController extends Controller
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
     * @param  \App\Http\Requests\StoreIssueBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIssueBookRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IssueBook  $issueBook
     * @return \Illuminate\Http\Response
     */
    public function show(IssueBook $issueBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIssueBookRequest  $request
     * @param  \App\Models\IssueBook  $issueBook
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIssueBookRequest $request, IssueBook $issueBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IssueBook  $issueBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(IssueBook $issueBook)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Fragment;
use Illuminate\Http\Request;

class FragmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        echo 'gogu';
    }
    public function index()
    {
        //
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
     * @param  \App\Models\Fragment  $fragment
     * @return \Illuminate\Http\Response
     */
    public function show(Fragment $fragment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fragment  $fragment
     * @return \Illuminate\Http\Response
     */
    public function edit(Fragment $fragment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fragment  $fragment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fragment $fragment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fragment  $fragment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fragment $fragment)
    {
        //
    }
}

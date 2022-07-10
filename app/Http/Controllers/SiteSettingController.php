<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
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
    public function showChangePassword(){

        return view('admin.settings.changepassword');
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
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function show(SiteSetting $siteSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function editAbout(Request $request)
    {
        $post = SiteSetting::first()->about;
        return view('admin.about.about_me', compact('post'));
    }

    public function editConfidentiality(Request $request)
    {
        $post = SiteSetting::first()->confidentiality;
        return view('admin.about.confidentiality', compact('post'));

    }

    public function editTerms(Request $request)
    {
        $post = SiteSetting::first()->terms;
        return view('admin.about.terms', compact('post'));
    }

    public function saveAbout(Request $request)
    {
        $post = SiteSetting::first();
        $post->about = $request->input('text');
        $post->save();
        return redirect()->route('admin.about');
    }
    public function saveConfidentiality(Request $request)
    {
        $post = SiteSetting::first();
        $post->confidentiality = $request->input('text');
        $post->save();
        return redirect()->route('admin.confidentiality');

    }
    public function saveTerms(Request $request)
    {
        $post = SiteSetting::first();
        $post->terms = $request->input('text');
        $post->save();
        return redirect()->route('admin.terms');

    }


}

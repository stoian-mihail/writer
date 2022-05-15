<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Post;
use App\Models\Fragment;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\seoUrlTrait;
use App\Http\Traits\storeImagesTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use seoUrlTrait;
    use storeImagesTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function indexAdmin()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PostCategory::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input_data = $request->all();
        $validator = Validator::make($request->all(), [
            'title' => ['string', 'min:2', 'regex:/^[a-zA-Z0-9\s-]{2,200}$/', 'max:200', 'required', Rule::unique('posts')],
            'text' => ['string', 'min:2', 'required'],
            'meta_title' => ['string','max:500', 'nullable'],
            'meta_description' => ['string','max:5000', 'nullable'],
            'albumImage' => ['array', 'required', 'max:12'],
            'albumImage.*' => ['mimes:jpg,jpeg,png,bmp', 'max:20000', 'required'],
        ]);
        if($validator->passes()){
            $seo_title = $this->seoUrl($input_data['title']);
            $post = Post::make([
                'title'=>$input_data['title'],
                'text'=>$input_data['text'],
                'slug'=>$seo_title,
                'category_id'=>$input_data['category_id'],
                'meta_title'=>$input_data['meta_title'],
                'meta_description'=>$input_data['meta_description']
            ]);
            $post->save();
            // now we store the images and also create the thumbnail
            $this->storeImages($input_data, "PostPhoto", "posts",$seo_title, $post);
            Session::flash('message', "Evenimentul a fost adaugat cu success!");
            return redirect()->route('admin.posts.index');
        }
        else{
            return redirect()->back()->withInput($input_data)->withErrors($validator);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = PostCategory::all();
        return view('admin.posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $input_data = $request->all();
        $old_seo_title =''.$post->slug;
        $validator = Validator::make($request->all(), [
            'title' => ['string', 'min:2', 'regex:/^[a-zA-Z0-9\s-]{2,200}$/', 'max:200', 'required', Rule::unique('posts')->ignore($post->title, 'title')],
            'text' => ['string', 'min:2', 'required'],
            'meta_title' => ['string','max:500', 'nullable'],
            'meta_description' => ['string','max:5000', 'nullable'],
            'albumImage' => ['array', 'max:12'],
            'albumImage.*' => ['mimes:jpg,jpeg,png,bmp', 'max:20000', 'required'],
        ]);
        if($validator->passes()){
            if($input_data['is_main'] == true){
                $this->makeMain($post->id);
            }
            $seo_title = $this->seoUrl($input_data['title']);
            $post->update($request->input());
            $post->slug = $seo_title;
            if(!empty($input_data['albumImage'])){
                $post->photo->delete();
                Storage::delete("public/posts/$old_seo_title/");
                $this->storeImages($input_data, "PostPhoto", "posts",$seo_title, $post);
            }
            $post->save();
            Session::flash('message', "Modificarile au fost salvate cu success!");
            return redirect()->route('admin.posts.index');
        }
        else{
            return redirect()->back()->withInput($input_data)->withErrors($validator);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $seo_title =''.$post->slug;
        dd($seo_title);
        Storage::delete("public/posts/$seo_title/");
        $post->delete();
        return redirect()->back();
    }

    protected function makeMain($id){
        $post = Post::find($id);
        Post::where('is_main', true)->update(['is_main'=>false]);
        News::where('is_main', true)->update(['is_main'=>false]);
        Fragment::where('is_main', true)->update(['is_main'=>false]);
        $post->is_main = true;
        $post->save();
    }
}

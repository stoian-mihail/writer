<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Post;
use App\Models\Fragment;
use Illuminate\Support\Str;
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
        $posts = Post::all();
        return view('catalog.posts.index', compact('posts'));
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
        // dd($input_data);

        $validator = Validator::make($request->all(), [
            'title' => ['string', 'min:2', 'required', Rule::unique('posts')],
            'text' => ['string', 'min:2', 'required'],
            'meta_title' => ['string','max:500', 'nullable'],
            'meta_description' => ['string','max:5000', 'nullable'],
            'albumImage' => ['array', 'max:12'],
            'albumImage.*' => ['mimes:jpg,jpeg,png,bmp', 'max:20000'],
        ]);
        if($validator->passes()){
            $uuid =  Str::uuid()->toString().now()->format('Y-m-d-H-m-s');

            $seo_title = $this->seoUrl($input_data['title']);
            $post = Post::make([
                'title'=>$input_data['title'],
                'text'=>$input_data['text'],
                'slug'=>$seo_title,
                'category_id'=>$input_data['category_id'],
                'meta_title'=>$input_data['meta_title'],
                'meta_description'=>$input_data['meta_description'],
                'storage_folder'=>"public/posts/$uuid/",
                'uuid'=>$uuid
            ]);
            $post->save();
            // now we store the images and also create the thumbnail
            $this->storeImages($input_data, "PostPhoto", "posts",$uuid, $post);
            Session::flash('message', "Articolul a fost adaugat cu success!");
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
            'title' => ['string', 'min:2', 'regex:/^[a-zA-Z0-9\s-]{2,1000}$/', 'max:1000', 'required', Rule::unique('posts')->ignore($post->title, 'title')],
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
                if($post->photo){
                    $post->photo()->delete();
                }
                Storage::delete("public/posts/$post->uuid/");
                $this->storeImages($input_data, "PostPhoto", "posts",$post->uuid, $post);
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
        Storage::deleteDirectory("public/posts/$post->uuid/");
        $post->photo()->delete();
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

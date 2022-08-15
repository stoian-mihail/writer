<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\News;
use App\Models\Post;
use App\Models\Product;
use App\Models\Fragment;
use App\Models\PostPhoto;
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
    public function index(Request $request)
    {
        if (request('category')) {
            $posts = PostCategory::where('slug', request('category'))->first()->posts;
        } else {
            $posts = Post::all();
        }

        return view('catalog.posts.index', compact('posts'));
    }

    public function indexAdmin(Request $request)
    {

        $input_data = $request->all();

        $currentURL = url()->full();

        $posts = Post::with('category')
            ->when(isset($input_data['status']) && $input_data['status'] != 'default', function ($query) use ($input_data) {
                    $query->where('status', $input_data['status']);
                     })
            ->when(isset($input_data['category']) && $input_data['category'] != 'default' , function ($query) use ($input_data) {
                        $query->whereHas('category', function ($query) use ($input_data) {
                            $query->where('id', $input_data['category']);
                        });
                    })
            ->when(isset($input_data['order_by']) && $input_data['order_by'] != 'default', function ($query) use ($input_data) {
                        $query->orderBy('created_at', $input_data['order_by']);
                    })
            ->paginate(24);

        $route  =  route('admin.posts.index');
        $categories = PostCategory::all();
        $posts->withPath($currentURL);
        session(['filter_criteria' => $input_data]);
        return view('admin.posts.index', compact('posts', 'route', 'categories'))->with('filter_criteria', session('filter_criteria'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PostCategory::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
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
            'title' => ['string', 'min:2', 'required', Rule::unique('posts')],
            'text' => ['string', 'min:2', 'required'],
            'meta_title' => ['string', 'max:500', 'nullable'],
            'tags.*' => ['regex:/^[a-zA-Z0-9\s-]{2,15}$/', 'required'],
            'tags' => ['array'],
            'meta_description' => ['string', 'max:5000', 'nullable'],
            'albumImage' => ['array', 'max:12'],
            'albumImage.*' => ['mimes:jpg,jpeg,png,bmp', 'max:20000'],
        ]);
        if ($validator->passes()) {
            $uuid =  Str::uuid()->toString() . now()->format('Y-m-d-H-m-s');

            $seo_title = $this->seoUrl($input_data['title']);
            $post = Post::make([
                'title' => $input_data['title'],
                'text' => $input_data['text'],
                'slug' => $seo_title,
                'category_id' => $input_data['category_id'],
                'meta_title' => $input_data['meta_title'],
                'meta_description' => $input_data['meta_description'],
                'storage_folder' => "public/posts/$uuid/",
                'uuid' => $uuid
            ]);
            $post->save();
            $post->tag($input_data['tags']);
            // now we store the images and also create the thumbnail
            $this->storeImages($input_data, "PostPhoto", "posts/$post->uuid", $seo_title, $post);
            Session::flash('message', "Articolul a fost adaugat cu success!");
            return redirect()->route('admin.posts.index');
        } else {
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
        $categories = PostCategory::all();
        $books = Product::all();
        return view('catalog.posts.show', compact('post', 'categories', 'books'));
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
        $tags = $post->tags;
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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
        // dd($request->all());
        $input_data = $request->except(['tags', 'albumImage']);

        $validator = Validator::make($request->all(), [
            'title' => ['string', 'min:2', 'max:1000', 'required', Rule::unique('posts')->ignore($post->title, 'title')],
            'text' => ['string', 'min:2', 'required'],
            'meta_title' => ['string', 'max:500', 'nullable'],
            'meta_description' => ['string', 'max:5000', 'nullable'],
            'tags.*' => ['regex:/^[a-zA-Z0-9\s-]{2,15}$/'],
            'tags' => ['array'],
            'albumImage' => ['array', 'nullable', 'max:12'],
            'albumImage.*' => ['mimes:jpg,jpeg,png,bmp', 'max:20000', 'required'],
        ]);
        if ($validator->passes()) {
            if ($input_data['is_main'] == true) {
                $this->makeMain($post->id);
            }
            $seo_title = $this->seoUrl($input_data['title']);
            $post->update($input_data);
            $post->slug = $seo_title;
            $input_data = $request->all();
            if ($input_data['albumImage']) {
                if ($post->photo) {
                    $post->photo()->delete();
                }

                Storage::deleteDirectory("public/posts/$post->uuid/");
                $this->storeImages($input_data, "PostPhoto", "posts/$post->uuid", $seo_title, $post);
            }

            $post->save();

            $post->tag($request->input('tags'));
            Session::flash('message', "Modificarile au fost salvate cu success!");
            return redirect()->route('admin.posts.index');
        } else {
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

    public function destroyPhoto(Request $request)
    {
        $post_photo = PostPhoto::find($request->input('photo_id'));
        $post = $post_photo->post;
        Storage::deleteDirectory("public/posts/$post->uuid/");
        $post->photo()->delete();

        return response()->json(['success' => true]);
    }

    private function makeMain($id)
    {
        $post = Post::find($id);
        Post::where('is_main', true)->update(['is_main' => false]);
        News::where('is_main', true)->update(['is_main' => false]);
        Fragment::where('is_main', true)->update(['is_main' => false]);
        $post->is_main = true;
        $post->save();
    }
}

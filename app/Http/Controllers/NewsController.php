<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Post;
use App\Models\Product;
use App\Models\Fragment;
use App\Models\NewsPhoto;
use Illuminate\Support\Str;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\seoUrlTrait;
use App\Http\Traits\storeImagesTrait;
use App\Http\Traits\ConvertImageTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Traits\createThumbnailTrait;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    use seoUrlTrait;
    use createThumbnailTrait;
    use ConvertImageTrait;
    use storeImagesTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = News::all();
        $books = Product::all();

        $categories = NewsCategory::all();

        return view('catalog.news.index', compact('posts','categories','books'));
    }
    public function indexAdmin(Request $request)
    {
        $input_data = $request->all();

        $currentURL = url()->full();

        $posts = News::with('category')
            ->when(isset($input_data['status']) && $input_data['status'] != 'default', function ($query) use ($input_data) {
                $query->where('status', $input_data['status']);
            })
            ->when(isset($input_data['category']) && $input_data['category'] != 'default', function ($query) use ($input_data) {
                $query->whereHas('category', function ($query) use ($input_data) {
                    $query->where('id', $input_data['category']);
                });
            })
            ->when(isset($input_data['order_by']) && $input_data['order_by'] != 'default', function ($query) use ($input_data) {
                $query->orderBy('created_at', $input_data['order_by']);
            })
            ->paginate(24);

        $route  = 'admin.news.index';
        $categories = NewsCategory::all();

        $posts->withPath($currentURL);

        session(['filter_criteria' => $input_data]);
        return view('admin.news.index', compact('posts', 'route', 'categories'))->with('filter_criteria', session('filter_criteria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $categories = NewsCategory::all();
        return view('admin.news.create', ['categories' => $categories]);
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
            'title' => ['string', 'min:2', 'regex:/^[a-zA-Z0-9\s-]{2,200}$/', 'max:200', 'required', Rule::unique('news')],
            'text' => ['string', 'min:2', 'required'],
            'meta_title' => ['string', 'max:500', 'nullable'],
            'meta_description' => ['string', 'max:5000', 'nullable'],
            'albumImage' => ['array',  'max:12'],
            'albumImage.*' => ['mimes:jpg,jpeg,png,bmp', 'max:20000'],
        ]);
        if ($validator->passes()) {
            $uuid =  Str::uuid()->toString() . now()->format('Y-m-d-H-m-s');

            $seo_title = $this->seoUrl($input_data['title']);
            $news = News::make([
                'title' => $input_data['title'],
                'text' => $input_data['text'],
                'slug' => $seo_title,
                'category_id' => $input_data['category_id'],
                'meta_title' => $input_data['meta_title'],
                'meta_description' => $input_data['meta_description'],
                'storage_folder' => "public/news/$uuid/",

                'uuid' => $uuid
            ]);
            $news->save();
            // now we store the images and also create the thumbnail
            $this->storeImages($input_data, "NewsPhoto", "news/$news->uuid", $seo_title,  $news);
            Session::flash('message', "Evenimentul a fost adaugat cu success!");
            return redirect()->route('admin.news.index');
        } else {
            return redirect()->back()->withInput($input_data)->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {

        $books = Product::all();
        $categories = NewsCategory::all();
        return view('catalog.news.show', [
            'post' => $news,
            'books' => $books,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $post = $news;
        $categories = NewsCategory::all();
        return view('admin.news.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)

    {

        $post = $news;

        $input_data = $request->except(['albumImage', 'submit_btn']);

        $validator = Validator::make($request->all(), [
            'title' => ['string', 'min:2', 'regex:/^[a-zA-Z0-9\s-]{2,1000}$/', 'max:1000', 'required', Rule::unique('fragments')->ignore($post->title, 'title')],
            'text' => ['string', 'min:2', 'required'],
            'meta_title' => ['string', 'max:500', 'nullable'],
            'meta_description' => ['string', 'max:5000', 'nullable'],
            'albumImage' => ['array', 'max:12', 'nullable'],
            'albumImage.*' => ['mimes:jpg,jpeg,png,bmp', 'max:20000', 'nullable'],
        ]);
        if ($validator->passes()) {
            if ($input_data['is_main'] == true) {
                $this->makeMain($post->id);
            }
            $seo_title = $this->seoUrl($input_data['title']);
            $post->update($input_data);
            $post->slug = $seo_title;
            // de imbunatatit denumirea, sau de scapat de variabila input data aici sau sus
            $input_data = $request->all();

            if (!empty($input_data['albumImage'])) {
                if ($post->photo) {
                    $post->photo->delete();
                }
                Storage::deleteDirectory("public/news/$post->uuid/");


                $this->storeImages($input_data, "NewsPhoto", "news/$post->uuid", $seo_title, $post);
            }
            $post->save();
            Session::flash('message', "Modificarile au fost salvate cu success!");
            return redirect()->route('admin.news.index');
        } else {
            return redirect()->back()->withInput($input_data)->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = News::find($id);
        $seo_title = '' . $post->slug;
        // dd($seo_title);
        Storage::deleteDirectory("public/news/$seo_title/");
        $post->delete();
        return redirect()->back();
    }

    protected function makeMain($id)
    {
        $post = News::find($id);
        Post::where('is_main', true)->update(['is_main' => false]);
        News::where('is_main', true)->update(['is_main' => false]);
        Fragment::where('is_main', true)->update(['is_main' => false]);
        $post->is_main = true;
        $post->save();
    }

    public function destroyPhoto(Request $request)
    {
        $post_photo = NewsPhoto::find($request->input('photo_id'));
        $post = $post_photo->post;
        Storage::deleteDirectory("public/news/$post->uuid/");
        $post->photo()->delete();

        return response()->json(['success' => true]);
    }
}

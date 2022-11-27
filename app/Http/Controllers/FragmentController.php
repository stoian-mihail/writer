<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Post;
use App\Models\Product;
use App\Models\Fragment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Validation\Rule;
use App\Http\Traits\seoUrlTrait;
use App\Models\FragmentCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class FragmentController extends Controller
{

    use seoUrlTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin(Request $request)
    {
        // $posts = Fragment::all();
        // return view('admin.fragments.index', compact('posts'));

        $input_data = $request->all();

        $currentURL = url()->full();

        $posts = Fragment::with('volume')
            ->when(isset($input_data['status']) && $input_data['status'] != 'default', function ($query) use ($input_data) {
                    $query->where('status', $input_data['status']);
                     })
            ->when(isset($input_data['category']) && $input_data['category'] != 'default' , function ($query) use ($input_data) {
                        $query->whereHas('volume', function ($query) use ($input_data) {
                            $query->where('category_id', $input_data['category']);
                        });
                    })
            ->when(isset($input_data['order_by']) && $input_data['order_by'] != 'default', function ($query) use ($input_data) {
                        $query->orderBy('created_at', $input_data['order_by']);
                    })
            ->paginate(24);

        $route  =  'admin.fragments.index';
        $categories = ProductCategory::all();

        $posts->withPath($currentURL);
        
        session(['filter_criteria' => $input_data]);
        return view('admin.fragments.index', compact('posts', 'route', 'categories'))->with('filter_criteria', session('filter_criteria'));
    }
    public function index()
    {
        $posts = Fragment::all();
        return view('catalog.fragments.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $volumes = Product::select('id', 'prod_name')->get();
        return view('admin.fragments.create', [
            'volumes' => $volumes,
            // 'categories'=>FragmentCagory::all()
        ]);
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
            'title' => ['string', 'min:2', 'max:1000', 'required', Rule::unique('fragments')],
            'text' => ['string', 'min:2', 'required'],
            'meta_title' => ['string', 'max:500', 'nullable'],
            'meta_description' => ['string', 'max:5000', 'nullable'],
            // 'albumImage' => ['array', 'required', 'max:12'],
            // 'albumImage.*' => ['mimes:jpg,jpeg,png,bmp', 'max:20000', 'required'],
        ]);
        if ($validator->passes()) {
            $uuid =  Str::uuid()->toString() . now()->format('Y-m-d-H-m-s');

            $seo_title = $this->seoUrl($input_data['title']);
            $news = Fragment::make([
                'title' => $input_data['title'],
                'text' => $input_data['text'],
                'slug' => $seo_title,
                'meta_title' => $input_data['meta_title'],
                'meta_description' => $input_data['meta_description'],
                'volume_id' => $input_data['volume_id'],
                'uuid' => $uuid
            ]);
            $news->save();
            // now we store the images and also create the thumbnail
            // $this->storeImages($input_data, "NewsPhoto", "news",$uuid, $news);
            Session::flash('message', "Fragmentul a fost adaugat cu success!");
            return redirect()->route('admin.fragments.index');
        } else {
            return redirect()->back()->withInput($input_data)->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fragment  $fragment
     * @return \Illuminate\Http\Response
     */
    public function show(Fragment $fragment)
    {
        return view('fragments.show', $fragment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fragment  $fragment
     * @return \Illuminate\Http\Response
     */
    public function edit(Fragment $fragment)
    {
        $post = $fragment;
        $volumes = Product::all();
        return view('admin.fragments.edit', compact('volumes', 'post'));
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
        $post = $fragment;
        $input_data = $request->all();
        $validator = Validator::make($request->all(), [
            'title' => ['string', 'min:2', 'max:1000', 'required', Rule::unique('fragments')->ignore($post->title, 'title')],
            'text' => ['string', 'min:2', 'required'],
            'meta_title' => ['string', 'max:500', 'nullable'],
            'meta_description' => ['string', 'max:5000', 'nullable'],
            // 'albumImage' => ['array', 'max:12'],
            // 'albumImage.*' => ['mimes:jpg,jpeg,png,bmp', 'max:20000', 'required'],
        ]);
        if ($validator->passes()) {
            if ($input_data['is_main'] == true) {
                $this->makeMain($post->id);
            }
            $seo_title = $this->seoUrl($input_data['title']);
            $post->update($request->input());
            $post->slug = $seo_title;
            $post->save();
            Session::flash('message', "Modificarile au fost salvate cu success!");
            return redirect()->route('admin.fragments.index');
        } else {
            return redirect()->back()->withInput($input_data)->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fragment  $fragment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Fragment::find($id);
        Storage::delete("public/fragments/$post->uuid/");
        $post->delete();
        return redirect()->back();
    }

    private function makeMain($id)
    {
        $post = Fragment::find($id);
        Post::where('is_main', true)->update(['is_main' => false]);
        News::where('is_main', true)->update(['is_main' => false]);
        Fragment::where('is_main', true)->update(['is_main' => false]);

        $post->is_main = true;
        $post->save();
    }
}

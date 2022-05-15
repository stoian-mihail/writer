<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\seoUrlTrait;
use App\Http\Traits\storeImagesTrait;
use App\Http\Traits\ConvertImageTrait;
use Illuminate\Support\Facades\Session;
use App\Http\Traits\createThumbnailTrait;
use BinshopsBlog\Models\BinshopsLanguage;
use Illuminate\Support\Facades\Validator;
use BinshopsBlog\Models\BinshopsCategoryTranslation;

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
        $news = News::all();
        return view('catalog.news.index', compact('news'));
    }
    public function indexAdmin()
    {
        return view('admin.news.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $categories = NewsCategory::all();
        return view('admin.news.create', ['categories'=>$categories

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
            'title' => ['string', 'min:2', 'regex:/^[a-zA-Z0-9\s-]{2,200}$/', 'max:200', 'required', Rule::unique('news')],
            'news_body' => ['string', 'min:2', 'required'],
            'meta_title' => ['string','max:500', 'nullable'],
            'meta_description' => ['string','max:5000', 'nullable'],
            'albumImage' => ['array', 'required', 'max:12'],
            'albumImage.*' => ['mimes:jpg,jpeg,png,bmp', 'max:20000', 'required'],
        ]);
        if($validator->passes()){
            $seo_title = $this->seoUrl($input_data['title']);
            $news = News::make([
                'title'=>$input_data['title'],
                'text'=>$input_data['news_body'],
                'slug'=>$seo_title,
                'category_id'=>$input_data['category_id'],
                'meta_title'=>$input_data['meta_title'],
                'meta_description'=>$input_data['meta_description']
            ]);
            $news->save();
            // now we store the images and also create the thumbnail
            $this->storeImages($input_data, "NewsPhoto", "news",$seo_title, $news);
            Session::flash('message', "Evenimentul a fost adaugat cu success!");
            return redirect()->route('admin.news');
        }
        else{
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
        return view('catalog.news.show', ['news'=>$news]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('admin.news.edit',['news'=>$news]);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}

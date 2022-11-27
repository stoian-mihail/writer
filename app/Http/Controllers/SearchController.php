<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Fragment;
use App\Models\News;
use App\Models\Product;

use Illuminate\Http\Request;
use App\Http\Traits\RawQuery;
use Illuminate\Support\Facades\Validator;


class SearchController extends Controller
{

    use RawQuery;

    public function index(Request $request)
    {

        $input_data = $request->all();
        $validator = Validator::make($request->input(), [
            'keywords' => ['sometimes', 'nullable', 'string'],
            'search_category' => ['required', 'string']
        ]);

        if ($validator->passes()) {

            $validated = $validator->valid();
            $keywords = $validated['keywords'];
            $model = $validated['search_category'];
 
        
        $query_title = $this->generateRawQuery($keywords, 'title');
        $query_text = $this->generateRawQuery($keywords, 'text');

        $model = 'App\\Models\\'.$model;
        $select_from_body = $model::whereRaw($query_text);
        $posts = $model::whereRaw($query_title)->union($select_from_body)->paginate(25);
        }
        // $photos = $this->orderPhotos($input_data, $photos);

        $count = $posts->total();
        $currentURL = url()->full();
        $posts->withPath($currentURL);

        session(['search_criteria' => $input_data]);
        session(['filter_criteria' => $input_data]);

        return view('admin.search.index', [
            'posts' => $posts,
            'route' => 'admin.search.index',
            'categories' =>[],

            'count' => $count,
        ])->with('search_criteria', session('search_criteria'))->with('filter_criteria', session('search_criteria'));
    }
}

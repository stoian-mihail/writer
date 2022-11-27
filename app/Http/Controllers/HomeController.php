<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Post;
use App\Models\Product;
use App\Models\Fragment;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = PostCategory::all();
        $books = Product::all();
        $mainPostType = 'articole';
        $mainPost = Post::where('is_main', true)->latest()->first();
        $linkToMain  = $mainPost ? route('posts.show', $mainPost) : '#';
        // dd($linkToMain);
        if ($mainPost == null) {
            $mainPostType = 'fragmente';
            $mainPost = Fragment::where('is_main', true)->first();
            $linkToMain = $mainPost ? route('fragments.show', ['volume' => $mainPost->volume, 'fragment' => $mainPost]) : '#';
            if ($mainPost  == null) {
                $mainPostType = 'evenimente';
                $mainPost = News::where('is_main', true)->latest()->first();
                $linkToMain  = $mainPost ? route('news.show', $mainPost) : '#';
                if ($mainPost == null) {
                    $mainPostType = 'articole';
                    $mainPost = Post::latest()->first();
                }
            }
        }
        $featured_news = News::where('is_main', false)->latest()->first();
        $featured_fragment = Fragment::where('is_main', false)->latest()->first();
        $latest_posts = Post::where('is_main', false)->latest()->get();
        $latest_books = Product::latest()->get();




        return view('home', compact('categories', 'books', 'mainPost', 'mainPostType', 'linkToMain', 'featured_news', 'featured_fragment', 'latest_posts','latest_books'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Validation\Rule;
use App\Http\Traits\seoUrlTrait;
use App\Http\Traits\storeImagesTrait;
use App\Models\ProductPhoto;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
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
        $posts = Product::all();
        return view('catalog.products.index', compact('posts'));
    }
    public function indexAdmin()
    {
        $posts = Product::all();
        $categories = ProductCategory::all();
        return view('admin.products.index', compact('categories', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.products.create', compact('categories'));
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
            'prod_name' => ['string', 'min:2', 'max:1000', 'required', Rule::unique('products')],
            'prod_description' => ['string', 'min:2', 'required'],
            'meta_title' => ['string', 'nullable'],
            'meta_description' => ['string', 'nullable'],
            'category_id' => ['nullable'],
            'available_at' => ['string', 'required'],
            'albumImage' => ['array', 'required', 'max:12'],
            'albumImage.*' => ['mimes:jpg,jpeg,png,bmp', 'max:20000', 'required'],
        ]);
        if ($validator->passes()) {
            $uuid =  Str::uuid()->toString() . now()->format('Y-m-d-H-m-s');
            $seo_title = $this->seoUrl($input_data['prod_name']);
            $post = Product::make([
                'prod_name' => $input_data['prod_name'],
                'prod_description' => $input_data['prod_description'],
                'available_at' => $input_data['available_at'],
                'slug' => $seo_title,
                'category_id' => $input_data['product_category'],
                'meta_title' => $input_data['meta_title'],
                'meta_description' => $input_data['meta_description'],
                'storage_folder' => "public/products/$uuid/",

                'uuid' => $uuid
            ]);
            $post->save();
            // now we store the images and also create the thumbnail
            $this->storeImages($input_data, "ProductPhoto", "products", $uuid, $post);
            return response()->json([
                'message' => 'Cartea tau a fost adaugata cu succes!',
                'success' => true
            ]);
        } else {
            return response()->json(['error' => $validator->errors()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $post = $product;
        $categories = ProductCategory::all();
        return view('admin.products.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //    $string =  Str::uuid()->toString().now()->format('Y-m-d-H-m-s');
        //     dd($string);
        $post = $product;
        $input_data = $request->all();
        $validator = Validator::make($request->all(), [
            'prod_name' => ['string', 'min:2', 'max:1000', 'required', Rule::unique('products')->ignore($post->prod_name, 'prod_name')],
            'prod_description' => ['string', 'min:2', 'required'],
            'meta_title' => ['string', 'nullable'],
            'meta_description' => ['string', 'nullable'],
            'category_id' => ['nullable'],
            'available_at' => ['string', 'nullable'],
            // 'albumImage' => ['array', 'max:12'],
            // 'albumImage.*' => ['mimes:jpg,jpeg,png,bmp', 'max:20000'],
        ]);
        if ($validator->passes()) {
            $seo_title = $this->seoUrl($input_data['prod_name']);
            $post->update([
                'prod_name' => $input_data['prod_name'],
                'prod_description' => $input_data['prod_description'],
                'available_at' => $input_data['available_at'],
                'slug' => $seo_title,
                'category_id' => $input_data['product_category'],
                'meta_title' => $input_data['meta_title'],
                'meta_description' => $input_data['meta_description']
            ]);
            // $post->save();
            if (isset($input_data['deleteIds'])) {
                foreach ($input_data['deleteIds'] as $id) {
                    $photo = ProductPhoto::find($id);
                    Storage::delete("public/products/$post->uuid/$photo->file_name");
                    $photo->delete();
                }
            }
            // now we store the images and also create the thumbnail
            $this->storeImages($input_data, "ProductPhoto", "products", $post->uuid, $post);
            return response()->json([
                'message' => 'Cartea tau a fost adaugata cu succes!',
                'success' => true
            ]);
        } else {
            return response()->json(['error' => $validator->errors()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Product::find($id);
        Storage::deleteDirectory("public/products/$post->uuid/");
        $post->delete();
        return redirect()->back();
    }
}

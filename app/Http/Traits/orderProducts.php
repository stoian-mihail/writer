<?php

namespace App\Http\Traits;


trait orderProducts
{

    public function orderProducts($input_data, $products)
    {
        if (!empty($input_data) && array_key_exists('order_by', $input_data) && $input_data['order_by']) {
            switch ($input_data['order_by']) {
                    // by price
                case "price_asc":
                    $products = $products->reject(function ($product) {
                        if ($product->prod_use != "De vanzare") {
                            return true;
                        }
                    })->sortBy('prod_price')->paginate(50);
                    break;
                case "price_desc":
                    $products = $products->reject(function ($product) {
                        if ($product->prod_use != "De vanzare") {
                            return true;
                        }
                    })->sortByDesc('prod_price')->paginate(50);

                    break;
                    //By date
                case "latest":
                    $products = $products->sortByDesc('created_at')->paginate(50);

                    break;
                case "oldest":
                    $products = $products->sortBy('created_at')->paginate(50);

                    break;
                    // by number of likes
                case "likes_asc":
                    $products = $products->sortBy('likes')->paginate(50);

                    break;
                case "likes_desc":
                    $products = $products->sortByDesc('likes')->paginate(50);

                    break;
                default:
                    $products = $products->paginate(50);
                    break;
            }
        } else {
            $products = $products->paginate(50);
        }
        return $products;
    }
}

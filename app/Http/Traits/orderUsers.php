<?php

namespace App\Http\Traits;


trait orderUsers
{

    public function orderUsers($input_data, $users)
    {
        if (!empty($input_data) && array_key_exists('order_by', $input_data) && $input_data['order_by']) {
            switch ($input_data['order_by']) {

                    //By photos count
                case "photos_desc":
                    $users = $users->sortByDesc('photos')->paginate(100);

                    break;
                case "photos_asc":
                    $users = $users->sortBy('photos')->paginate(100);

                    break;

                    //By followers count
                case "followers_desc":
                    $users = $users->sortByDesc('followers')->paginate(100);

                    break;
                case "followers_asc":
                    $users = $users->sortBy('followers')->paginate(100);

                    break;
                    // by number of likes
                case "likes_asc":
                    $users = $users->sortBy('receivedlikes')->paginate(100);

                    break;
                case "likes_desc":
                    $users = $users->sortByDesc('receivedlikes')->paginate(100);
                    break;

                    // by number of products
                case "products_asc":
                    $users = $users->sortBy('products')->paginate(100);

                    break;
                case "products_desc":
                    $users = $users->sortByDesc('products')->paginate(100);

                    break;
                default:
                    $users = $users->paginate(100);
                    break;
            }
        } else {
            $users = $users->paginate(100);
        }

        return $users;
    }
}

<?php

namespace App\Http\Traits;


trait orderAlbums
{

    public function orderAlbums($input_data, $albums)
    {
        if (!empty($input_data) && array_key_exists('order_by', $input_data) && $input_data['order_by']) {
            switch ($input_data['order_by']) {

                    //By date
                case "latest":
                    $albums = $albums->sortByDesc('created_at');
                    $albums = $albums->values();
                    $albums = $albums->paginate(25);

                    break;
                case "oldest":
                    $albums = $albums->sortBy('created_at');
                    $albums = $albums->values();
                    $albums = $albums->paginate(25);

                    break;
                    // by number of likes
                case "likes_asc":
                    $albums = $albums->sortBy('likes');
                    $albums = $albums->values();
                    $albums = $albums->paginate(25);
                    break;
                case "likes_desc":
                    $albums = $albums->sortByDesc('likes');
                    $albums = $albums->values();
                    $albums = $albums->paginate(25);

                    break;
                default:
                    $albums = $albums->paginate(25);
                    break;
            }
        } else {
            $albums = $albums->paginate(25);
        }
        return $albums;
    }
}

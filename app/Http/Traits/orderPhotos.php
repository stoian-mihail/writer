<?php

namespace App\Http\Traits;


trait orderPhotos
{

    public function orderPhotos($input_data, $photos)
    {
        if (!empty($input_data) && array_key_exists('order_by', $input_data) && $input_data['order_by']) {
            switch ($input_data['order_by']) {

                    //By date
                case "latest":
                    $photos = $photos->sortByDesc('created_at')->paginate(25);

                    break;
                case "oldest":
                    $photos = $photos->sortBy('created_at')->paginate(25);

                    break;
                    // by number of likes
                case "likes_asc":
                    $photos = $photos->sortBy('likes')->paginate(25);

                    break;
                case "likes_desc":
                    $photos = $photos->sortByDesc('likes')->paginate(25);

                    break;
                default:
                    $photos = $photos->paginate(25);
                    break;
            }
        } else {
            $photos = $photos->paginate(25);
        }
        return $photos;
    }
}

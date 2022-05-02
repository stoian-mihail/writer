<?php

namespace App\Http\Traits;


trait orderTags
{

    public function orderTags($input_data, $tags)
    {
        if (!empty($input_data) && array_key_exists('order_by', $input_data) && $input_data['order_by']) {
            switch ($input_data['order_by']) {

                    //By date
                case "photos_desc":
                    $tags = $tags->sortByDesc('photos_count');
                    $tags = $tags->values();


                    break;
                case "photos_cresc":
                    $tags = $tags->sortBy('photos_count');
                    $tags = $tags->values();


                    break;

                default:

                    break;
            }
        }
        return $tags;
    }
}

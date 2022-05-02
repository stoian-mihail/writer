<?php

namespace App\Http\Traits;

use App\Tags;

trait TagsTrait
{

    public function tag($tags)
    {
        $taglist = array();
        if (is_array($tags)) {
            foreach ($tags as $tagname) {
                $tagcheck = Tags::where('tag_name', $tagname)->first();
                if ($tagcheck === null) {
                    $tag = new Tags;
                    $tag->tag_name = $tagname;
                    $tag->save();
                    $taglist[] = $tag->id;
                } else {
                    $taglist[] = $tagcheck->id;
                }
            }
            $this->tags()->sync($taglist);
        } else {
            $this->tags()->sync([]);
        }
    }
}

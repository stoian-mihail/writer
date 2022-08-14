<?php

namespace App\Http\Traits;

use App\Models\Tag;

trait TagsTrait
{

    public function tag($tags)
    {
        $taglist = array();
        if (is_array($tags)) {
            foreach ($tags as $tagname) {
                $tagcheck = Tag::where('name', $tagname)->first();
                if ($tagcheck === null) {
                    $tag = new Tag;
                    $tag->name = $tagname;
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

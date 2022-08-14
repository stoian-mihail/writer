<?php

namespace App\Models;

use App\Http\Traits\TagsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, TagsTrait;
    protected $guarded = [];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function photo(){
        return $this->hasOne(PostPhoto::class, 'belongs_id');
    }
    public function category(){
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    }
}

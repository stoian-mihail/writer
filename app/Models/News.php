<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function photo(){
        return $this->hasOne(NewsPhoto::class, 'belongs_id');
    }

    public function category(){
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }
}

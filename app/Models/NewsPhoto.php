<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsPhoto extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function post(){
        return $this->belongsTo(News::class, 'belongs_id');
    }

    public function thumbnail(){
        return $this->belongsTo(PhotoThumbnail::class, 'thumbnail_id');
    }
}

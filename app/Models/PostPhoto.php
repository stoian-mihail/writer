<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPhoto extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function thumbnail(){
        return $this->belongsTo(PhotoThumbnail::class, 'thumbnail_id');
    }
}

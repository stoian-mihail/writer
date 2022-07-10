<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fragment extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function volume(){
        return $this->belongsTo(Product::class, 'volume_id');
    }
}

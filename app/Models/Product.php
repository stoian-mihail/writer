<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function photos(){
        return $this->hasMany(ProductPhoto::class, 'belongs_id', 'id');
    }
    public function photo(){
        return $this->hasOne(ProductPhoto::class, 'belongs_id', 'id');
    }
}

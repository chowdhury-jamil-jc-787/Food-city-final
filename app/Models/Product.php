<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}

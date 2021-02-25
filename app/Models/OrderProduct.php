<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use SoftDeletes;
    protected $fillable = ['order_id', 'product_id', 'price', 'quantity'];



    public function images()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_id', 'product_id');
    }

    public function mainImage()
    {
        return $this->hasOne('App\Models\ProductImage', 'product_id', 'product_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }
}

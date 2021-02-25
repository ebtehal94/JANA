<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;



class Order extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [ 'code', 'country_id', 'customer_id', 'status', 'delivery_price',
    'delivery_method', 'products_price','discount', 'payment_amount',
    'payment_method','payment_ref', 'total_price','promo_code', 'comments'];


    /**
     * Get the customer that owns the order.
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\User', 'customer_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    /**
     * Get the customer that owns the order.
     */
    public function captain()
    {
        return $this->belongsTo('App\Models\User', 'captain_id');
    }


    public function products()
    {
        return $this->hasMany('App\Models\OrderProduct');
    }


    public function location()
    {
        return $this->hasOne('App\Models\OrderLocation');
    }


    public function mainProduct()
    {
        return $this->hasOne('App\Models\OrderProduct');
    }

}

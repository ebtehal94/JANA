<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;



class Redeem extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['customer_id', 'offer_id', 'store_id', 'city_id', 'rating', 'comment'];


    /**
     * Get the customer that owns the order.
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }


    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }


    public function offer()
    {
      return $this->belongsTo('App\Models\Offer');
    }


    public function store()
    {
      return $this->belongsTo('App\Models\Store');
    }


}

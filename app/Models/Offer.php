<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;



class Offer extends Model
{

    use SoftDeletes;

    protected $fillable = ['store_id', 'category_id', 'code', 'title_ar', 'title_en', 'desc_en', 'desc_ar', 'status','price','price_before', 'discount_perc', 'status', 'expiry', 'used', 'created_by', 'approved_by'];


    public function redeems()
    {
      return $this->hasMany('App\Models\Redeem');
    }

    public function images()
    {
        return $this->hasMany('App\Models\OfferImage');
    }

    public function mainImage()
    {
        return $this->hasOne('App\Models\OfferImage');
    }


    public function branches()
    {
        return $this->belongsToMany('App\Models\Branch');
    }


    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }



}

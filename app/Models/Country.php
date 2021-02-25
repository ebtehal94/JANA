<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name_ar', 'name_en', 'short_code', 'currency_ar', 'currency_en', 'VAT', 'delivery_price'];

    // public function products()
    // {
    //     return $this->hasMany('App\Models\CountryProduct');
    // }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('stock', 'price', 'discount', 'status')->as('details');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }


}

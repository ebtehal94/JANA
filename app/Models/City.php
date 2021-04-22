<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name_ar'];


    public function offers()
    {
      return $this->hasMany('App\Models\Offer');
    }

    public function customers()
    {
      return $this->hasMany('App\Models\Customer');
    }


    public function redeems()
    {
        return $this->hasMany('App\Models\Redeem');
    }

    public function stores()
    {
        return $this->hasMany('App\Models\Store');
    }

    public function branches()
    {
        return $this->hasMany('App\Models\Branch');
    }


}

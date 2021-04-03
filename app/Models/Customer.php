<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use SoftDeletes;
    protected $fillable = [ 'city_id', 'name', 'email', 'mobile', 'status', 'password', 'otp',
                            'device_id', 'device_type', 'device_token' ];


    public function redeems()
    {
        return $this->hasMany('App\Models\Redeem');
    }


    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function subscription()
    {
        return $this->hasOne('App\Models\Subscription');
    }


    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

}

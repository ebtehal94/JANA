<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
  use SoftDeletes;
  protected  $fillable = ['id', 'city_id','name_en','name_ar','image','cr_number'];


  public function offers()
  {
      return $this->hasMany('App\Models\Offer');
  }


  public function redeems()
  {
      return $this->hasMany('App\Models\Redeem');
  }

  public function user()
  {
      return $this->hasOne('App\Models\User');
  }


  public function branches()
  {
      return $this->hasMany('App\Models\Branch');
  }


  public function city()
  {
      return $this->belongsTo('App\Models\City');
  }


}

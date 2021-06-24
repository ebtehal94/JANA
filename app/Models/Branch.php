<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

  protected  $fillable = ['id', 'title', 'store_id', 'city_id', 'location', 'url', 'type', 'lat', 'lng'];



  public function store()
  {
      return $this->belongsTo('App\Models\Store');
  }


  public function offers()
  {
      return $this->belongsToMany('App\Models\Offer');
  }


  public function city()
  {
      return $this->belongsTo('App\Models\City');
  }

}

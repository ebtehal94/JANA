<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

  protected  $fillable = ['id', 'title', 'city_id', 'location', 'url', 'type'];



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

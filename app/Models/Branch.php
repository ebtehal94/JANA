<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

  protected  $fillable = ['id', 'title', 'city_id', 'location', 'url', 'type'];


  /**
   * Get the category that owns the product.
   */
  public function store()
  {
      return $this->belongsTo('App\Models\Store');
  }


}

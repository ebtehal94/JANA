<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{

  use Searchable;
  protected  $fillable = ['id','title_en','title_ar'];


  /**
   * Get the category that owns the product.
   */
  public function category()
  {
      return $this->belongsTo('App\Models\Category');
  }


}

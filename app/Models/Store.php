<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
  use SoftDeletes;
  use Searchable;
  protected  $fillable = ['id', 'city_id','name_en','name_ar','cr_number'];


  /**
   * Get the products within this category.
   */
  // public function offers()
  // {
  //     return $this->hasMany('App\Models\Offer');
  // }

  /**
   * Get the filters within this category.
   */

  public function users()
  {
      return $this->hasMany('App\Models\User');
  }


  public function branches()
  {
      return $this->hasMany('App\Models\Branch');
  }



   public function toSearchableArray()
   {
       $array = $this->toArray();

       $array = $this->transform($array);
       // $array['category'] = $this->title_en.'|'.$this->title_ar;

       return $array;
   }

}

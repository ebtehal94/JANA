<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use Searchable;
  protected  $fillable = ['id','title_en','title_ar','sort'];


  /**
   * Get the products within this category.
   */
  public function products()
  {
      return $this->hasMany('App\Models\Product');
  }

  /**
   * Get the filters within this category.
   */
  public function filters()
  {
      return $this->hasMany('App\Models\Filter');
  }




   public function toSearchableArray()
   {
       $array = $this->toArray();

       $array = $this->transform($array);
       // $array['category'] = $this->title_en.'|'.$this->title_ar;

       return $array;
   }

}

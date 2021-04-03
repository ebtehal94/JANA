<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected  $fillable = ['id','title_en','title_ar','sort'];


  public function offers()
  {
      return $this->hasMany('App\Models\Offer');
  }


}

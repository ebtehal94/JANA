<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
  protected  $fillable = ['about_en', 'about_ar', 'terms_en', 'terms_ar'];
}

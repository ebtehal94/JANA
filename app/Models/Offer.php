<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['title_ar', 'title_en', 'desc_en', 'desc_ar', 'link', 'deadline'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
  protected  $fillable = ['id', 'customer_id', 'begins_at','expires_at', 'unit_price',
                           'cycle', 'discount', 'total_price', 'status', 'referred_by'];


  public function customer()
  {
    return $this->belongsTo('App\Models\Customer');
  }

}

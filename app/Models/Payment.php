<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  use SoftDeletes;
  protected $fillable = ['customer_id', 'amount', 'ref', 'card_number'];



  public function customer()
    {
      return $this->belongsTo('App\Models\Customer');
    }

}

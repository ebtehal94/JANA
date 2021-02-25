<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
  use SoftDeletes;
  protected  $fillable = ['id','code','type', 'amount','max_discount','min_price',
                           'status', 'expires_at','user_id','user_perc'];


   public function subscriptions()
   {
       return $this->hasMany('App\Models\Subscription', 'promo_code_id', 'id');
   }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  use SoftDeletes;
  protected $fillable = ['name','email','mobile', 'device_id','device_type','device_token'];

    /**
     * Get the orders of this customer.
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OrderLocation extends Model
{
    use SoftDeletes;
    protected $fillable = ['order_id', 'address', 'lat', 'lng'];


    public function order()
    {
        return $this->belongsTo('App\Models\Record', 'order_id', 'id');
    }
}

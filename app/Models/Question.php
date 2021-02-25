<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected  $fillable = ['id','name', 'email','subject','message', 'response', 'status', 'user_id'];

    public function owner()
    {
        return $this->belongsTo('App\Models\User');
    }
}

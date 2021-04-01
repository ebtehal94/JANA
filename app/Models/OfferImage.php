<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OfferImage extends Model
{


    protected $fillable = ['offer_id','link'];

    /**
     * Get the offer that owns the image.
     */
    public function offer()
    {
        return $this->belongsTo('App\Models\Offer');
    }

}

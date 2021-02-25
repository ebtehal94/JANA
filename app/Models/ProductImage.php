<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{

    use SoftDeletes;

    use Searchable;

    protected $touches = ['product'];

    protected $fillable = ['product_id','link'];

    /**
     * Get the product that owns the image.
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function orderProduct()
    {
        return $this->belongsTo('App\Models\OrderProduct', 'product_id', 'product_id');
    }

}

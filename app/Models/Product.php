<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;



class Product extends Model
{

    use SoftDeletes;
    use Searchable;

    protected $fillable = ['collection_id', 'category_id', 'filter_id', 'title_ar', 'title_en', 'desc_en', 'desc_ar', 'color','size','code'];

    //
    // public function price()
    // {
    //     return $this->hasOne('App\Models\CountryProduct');
    // }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }


    public function mainImage()
    {
        return $this->hasOne('App\Models\ProductImage');
    }

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function collection()
    {
        return $this->belongsTo('App\Models\Collection');
    }

    public function filter()
    {
        return $this->belongsTo('App\Models\Filter');
    }

    public function countries()
    {
        return $this->belongsToMany('App\Models\Country')->withPivot('stock', 'price', 'discount', 'status')->as('details')->withTimestamps();
    }



     public function toSearchableArray()
     {
       if ($this->countries && count($this->countries) >0){
         $array = $this->toArray();
         $array = $this->transform($array);
         $array['title']  = array('en' => $array['title_en'], 'ar' => $array['title_ar']);
         $array['desc']   = array('en' => $array['desc_en'], 'ar' => $array['desc_ar']);
         unset($array['title_en'],$array['title_ar']);
         unset($array['desc_ar'],$array['desc_en']);

         $array['images'] = $this->images->map(function ($data) {
             return $data['link'];
         })->toArray();

         if ($this->collection_id && $this->collection){
           $array['collection'] = array('en' => $this->collection->title_en, 'ar' => $this->collection->title_ar);
         }

         // insert prices (keys and values) for filtering
         foreach ($this->countries as $key => $country) {
           $array['price_' . $country->short_code]      = $country->details->price;
           $array['status_' . $country->short_code]     = $country->details->status;
         }

         $array['details']      = array();
         // insert other details (stock, price, status..)
         foreach ($this->countries as $key => $country) {
           unset($country->details->product_id);
           $array['details'][$country->short_code] = $country->details;
         }

         return $array;
       }else{
         return false;
       }
     }

}

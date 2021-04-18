<?php

namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use App\Models\Offer;
use App\Models\Store;
use App\Models\OfferImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class OfferController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
      $response                 = array();
      $response['slider']       = array();
      $info                     = $request->all();
      $stores                   = Store::orderby('views','desc')
                                       ->select('id','name_ar', 'name_en', 'views', 'image')
                                       ->take(6);
      if (isset($info['city_id'])){
       $city_id                  = $info['city_id'];
       $stores                   = $stores->whereHas('branches', function ($query) use ($city_id) {
                                             return $query->where('city_id', $city_id);
                                           });
      }
      $response['stores']       = $stores->get();

      $offers                   = Offer::with('mainImage', 'category:id,title_en,title_ar', 'store:id,name_en,name_ar')
                                       ->orderby('id','desc')
                                       ->whereIn('status', [1,2])
                                       ->take(9);

      if (isset($info['city_id'])){
        $city_id                  = $info['city_id'];
        $offers                   = $offers->whereHas('branches', function ($query) use ($city_id) {
                                              return $query->where('city_id', $city_id);
                                            });
      }

      $response['offers']       = $offers->get();
      $response['statusCode']   = 200;
      return $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
      $response                 = array();
      $info                     = $request->all();
      $offers                   = Offer::with('mainImage', 'category:id,title_en,title_ar', 'store:id,name_en,name_ar')
                                       ->select('id','title_en', 'title_ar', 'price_before', 'price', 'discount')
                                       ->orderby('id','desc');
      if (isset($info['status'])){
        $offers                   = $offers->whereIn('status', $info['status']);
      }
      if (isset($info['city_id'])){
        $city_id                  = $info['city_id'];
        $offers                   = $offers->whereHas('branches', function ($query) use ($city_id) {
                                              return $query->where('city_id', $city_id);
                                            });
      }
      if (isset($info['category_id'])){
        $offers                   = $offers->where('category_id', $info['category_id']);
      }
      if (isset($info['skip'])){
        $offers                   = $offers->skip($info['skip']);
      }
      if (isset($info['take'])){
        $offers                   = $offers->take($info['take']);
      }

      $response['offers']       = $offers->get();
      $response['statusCode']   = 200;
      return $response;
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
      $response       = array();
      $info           = $request->all();
      $Ofr            = Offer::where('id', $info['offer_id'])
                             // ->where('status', 1)
                             ->with('images:id,link')
                             ->first();
      if (isset($Ofr)){
        $response['offer']        = $Ofr;
        if(isset($info['customer_id'])){
          $response['redeems']      = $Ofr->redeems()->where('customer_id', $info['customer_id'])->count();
        }
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }

}

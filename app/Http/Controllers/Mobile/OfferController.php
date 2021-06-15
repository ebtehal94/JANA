<?php

namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\AppPhoto;
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
      $date                     = Carbon::now()->toDateString();
      $response                 = array();
      $response['slider']       = AppPhoto::select('id', 'link')->get();
      $info                     = $request->all();
      $stores                   = Store::orderby('views','desc')
                                       ->select('id','name_ar', 'name_en', 'views', 'image')
                                       ->where('status', 1)
                                       ->take(6);
      $response['stores']       = $stores->get();

      $offers                   = Offer::with('mainImage', 'category:id,title_en,title_ar', 'store:id,name_en,name_ar')
                                       ->orderby('id','desc')
                                       ->where('status', 1)
                                       ->whereDate('expiry', '>=', $date)
                                       ->take(9);

      // if (isset($info['city_id'])){
      //   $city_id                  = $info['city_id'];
      //   $offers                   = $offers->whereHas('branches', function ($query) use ($city_id) {
      //                                         return $query->where('city_id', $city_id);
      //                                       });
      // }

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
      $user                     = \Auth::Guard('api')->user();
      $offers                   = Offer::with('mainImage', 'category:id,title_en,title_ar', 'store:id,name_en,name_ar')
                                       ->with('category:id,title_en,title_ar', 'store:id,name_en,name_ar,image')
                                       ->select('id','title_en', 'title_ar', 'price_before', 'price', 'discount_perc')
                                       ->orderby('id','desc');
      if (!isset($user)){
        $offers                   = $offers->where('status', 1)
                                           ->whereDate('expiry', '>=', Carbon::now()->toDateString());
      }

      if (isset($info['category_id'])){
        $offers                   = $offers->where('category_id', $info['category_id']);
      }
      if (isset($info['store_id'])){
        $offers                   = $offers->where('store_id', $info['store_id']);
      }
      if (isset($info['search'])){
        $search                   = $info['search'];
        $offers                   = $offers->where(function ($query) use ($search) {
                                          return $query->where('title_ar', 'like', '%'.$search.'%')
                                                       ->orWhere('title_en', 'like', '%'.$search.'%');
                                        });
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
      $date           = Carbon::now()->toDateString();
      $info           = $request->all();
      $Ofr            = Offer::where('id', $info['offer_id'])
                             ->where('status', 1)
                             ->whereDate('expiry', '>=', $date)
                             ->with('category:id,title_en,title_ar', 'store:id,name_en,name_ar,image','images')
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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function myRedeems(Request $request)
    {
      $response       = array();
      $info           = $request->all();
      $customer       = Customer::where('id', $info['customer_id'])
                                ->first();
      if (isset($customer)){
        $redeems          = $customer->redeems()->where('used', 1)->get();
        foreach ($redeems as $redeem) {
          $redeem->offer        = $redeem->offer()->select('id','title_en', 'title_ar', 'desc_en', 'desc_ar', 'price_before', 'price', 'discount_perc')->with('mainImage:id,link')->first();
        }
        $response['redeems']      = $redeems;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }

}

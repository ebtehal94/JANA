<?php

namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\AppPhoto;
use App\Models\Offer;
use App\Models\Store;
use App\Models\Redeem;
use App\Models\OfferImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class RedeemController extends Controller
{


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function CustomerRedeem(Request $request)
    {
      $response       = array();
      $info           = $request->all();
      $Ofr            = Offer::find($info['offer_id']);
      $customer       = Customer::find($info['customer_id']);

      if ($Ofr && $customer){
        // $response['offer']        = $Ofr;
        if (isset($Ofr->expiry) && Carbon::parse($Ofr->expiry) < Carbon::now()){
          $response['msg']          = 'Expired';
          $response['statusCode']   = 401;
          return $response;
        }

        if (isset($customer) && $customer->status == 0){
          $response['msg']          = 'Not subsbscribed';
          $response['statusCode']   = 403;
          return $response;
        }

          // $redeems      = $Ofr->redeems()->where('customer_id', $info['customer_id'])->count();
          // if(count($redeems) > 0){
          // $response['msg']          = 'Already used';
          // $response['statusCode']   = 402;
          // return $response;
        $redeem                   = $Ofr->redeems()->create(['offer_id'     => $Ofr->id,
                                                             'store_id'     => $Ofr->store_id,
                                                             'city_id'      => $customer->city_id,
                                                             'customer_id'  => $customer->id]);

        $response['redeem_id']    = $redeem->id;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }


    public function StoreRedeemCheck(Request $request)
    {
      $response       = array();
      $info           = $request->all();
      $redeem         = Redeem::where('id', $info['redeem_id'])
                              ->where('store_id', $info['store_id'])
                              ->first();
      if (isset($redeem)){
        $offer                    = $redeem->offer()->select('id','title_en', 'title_ar', 'desc_en', 'desc_ar', 'price_before', 'price', 'discount_perc', 'expiry')->with('mainImage:id,offer_id,link')->first();
        if (isset($Ofr->expiry) && Carbon::parse($Ofr->expiry) < Carbon::now()){
          $response['msg']          = 'Expired';
          $response['statusCode']   = 401;
          return $response;
        }

        $response['offer']        = $offer;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }


    public function StoreRedeem(Request $request)
    {
      $response       = array();
      $info           = $request->all();
      $redeem         = Redeem::where('id', $info['redeem_id'])
                              ->where('store_id', $info['store_id'])
                              ->first();
      if (isset($redeem)){
        $offer                    = $redeem->offer;
        if (isset($Ofr->expiry) && Carbon::parse($Ofr->expiry) < Carbon::now()){
          $response['msg']          = 'Expired';
          $response['statusCode']   = 401;
          return $response;
        }

        if (isset($Ofr->used) && $Ofr->used == 1){
          $response['msg']          = 'Used';
          $response['statusCode']   = 402;
          return $response;
        }
        $redeem->used             = 1;
        $redeem->save();

        $response['offer']        = $offer;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }

}

<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\PromoCode;

use Illuminate\Http\Request;

class PromoCodeController extends Controller
{

  public function index()
  {
    $promocodes = PromoCode::all();
    return $promocodes;
  }

  public function show($id)
  {
    return PromoCode::find($id);
  }

  public function create(Request $request)
  {
    $code                     = $request->all();
    $response                 = array();
    $response['promocode']    = PromoCode::create($code);
    if ($response['promocode']){
      $response['statusCode']   = 200;
    }else{
      $response['statusCode']   = 400;
    }
    return $response;
  }

  public function update(Request $request)
  {
    $info               = $request->all();
    $code               = PromoCode::find($request->id);
    $response           = array();
    if ($code){
      $code->update($info);
      $response['promocode']     = $code;
      $response['statusCode']   = 200;
    }else{
      $response['statusCode']   = 400;
    }
    return $response;
  }

  public function remove($id)
  {
    $code = PromoCode::find($id);
    $code->delete();
    return "Code Deleted";
  }

  public function check(Request $request)
  {
    $response           = array();
    $promoCode          = PromoCode::where('code', $request->code)
                                    ->select('id', 'code', 'type','amount','expires_at','status','max_discount','min_price')
                                    ->first();

    if( isset($promoCode) && !empty($promoCode) ){
      if($promoCode->status != 0){
        $response['statusCode'] = 402;
        $response['msg']        = 'PromoCodeInActive';
        return $response;
      }

      if(isset($promoCode->expires_at) && (Carbon::parse($promoCode->expires_at) < Carbon::now())){
        $response['statusCode'] = 401;
        $response['msg']        = 'PromoCodeExpired';
        return $response;
      }

      $response['promoCode'] = $promoCode;
      $response['statusCode'] = 200;
    }else{
      $response['statusCode'] = 400;
      $response['msg']        = 'NotFound';
    }
    return $response;
  }
}

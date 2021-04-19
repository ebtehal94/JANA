<?php

namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
      $response                 = array();
      $info                     = $request->all();
      $stores                   = Store::orderby('id','desc')
                                       ->select('id','name_ar', 'name_en', 'views', 'image');
      if (isset($info['city_id'])){
        $city_id                  = $info['city_id'];
        $stores                   = $stores->whereHas('branches', function ($query) use ($city_id) {
                                              return $query->where('city_id', $city_id);
                                            });
      }
      if (isset($info['skip'])){
        $stores                   = $stores->skip($info['skip']);
      }
      if (isset($info['take'])){
        $stores                   = $stores->take($info['take']);
      }
      // if (isset($info['city_id']) && count($info['city_id']) > 0){
      //   $stores                   = $stores->where('city_id', $info['city_id']);
      // }
      $response['stores']       = $stores->get();
      $response['statusCode']   = 200;
      return $response;
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
      $response       = array();
      $info           = $request->all();
      $Str            = Store::where('id', $info['store_id'])
                             ->with('branches:id,title,city_id')
                             ->first();
      if (isset($Str)){
        $Str->active_offers  = $Str->offers()->where('status', 1)->count();
        $Str->all_offers     = $Str->offers()->count();
        $Str->offers         = $Str->offers()
                                   ->select('id','title_en','title_ar')
                                   ->where('status', 1)
                                   ->with('mainImage')
                                   ->orderBy('id', 'desc')
                                   ->get();
        $Str->increment('views');
        $response['store']        = $Str;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }


}

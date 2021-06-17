<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Store;
use App\Models\Offer;
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
    public function index(Request $request)
    {
      $response                 = array();
      $info                     = $request->all();
      $user                     = \Auth::Guard('api')->user();
      $offers                   = Offer::with('images', 'category:id,title_en,title_ar', 'store:id,name_en,name_ar')
                                       ->orderby('id','desc');
      if (isset($info['status']) && count($info['status']) > 0){
        $offers                   = $offers->whereIn('status', $info['status']);
      }

      if (isset($info['search'])){
        $search                   = $info['search'];
        $offers                   = $offers->where(function ($query) use ($search) {
                                          return $query->where('title_ar', 'like', '%'.$search.'%')
                                                       ->orWhere('title_en', 'like', '%'.$search.'%');
                                        });
      }

      if (isset($info['active']) && $info['active'] == 1){
        $offers                   = $offers->whereDate('expiry', '<', Carbon::now()->toDateString());
      }elseif(isset($info['active']) && $info['active'] == 0){
        $offers                   = $offers->whereDate('expiry', '>=', Carbon::now()->toDateString());
      }

      if (isset($info['from'])){
        $offers                   = $offers->whereDate('created_at', '>=', $info['from']);
      }
      if (isset($info['to'])){
        $offers                   = $offers->whereDate('created_at', '<=', $info['to']);
      }

      if (isset($user) && $user->rule != 'admin'){
        $offers                   = $offers->where('store_id', $user->store_id);
      }

      $response['offers']       = $offers->get();
      $response['statusCode']   = 200;
      return $response;
    }

    public function dashboard(Request $request)
    {
      $response                 = array();
      $user                     = \Auth::Guard('api')->user();
      $todaysDate               = Carbon::now()->toDateString();
      $aWeekAgo                 = Carbon::now()->subDays(7)->toDateString();
      $statistics               = array();
      if (isset($user) && $user->rule == 'admin'){
        $statistics['all_offers']     = Offer::count();
        $statistics['active_offers']  = Offer::where('status', 1)->whereDate('expiry', '>', $todaysDate)->count();
        $statistics['new_offers']     = Offer::whereDate('created_at', '>=', $aWeekAgo)->count();
        $statistics['all_stores']     = Store::count();
        $statistics['new_stores']     = Store::whereDate('created_at', '>=', $aWeekAgo)->count();
        $statistics['all_customers']  = Customer::count();
        $statistics['new_customers']  = Customer::whereDate('created_at', '>=', $aWeekAgo)->count();
      }else{
        $statistics['all_offers']     = $user->store->offers()->count();
        $statistics['active_offers']  = $user->store->offers()->where('status', 1)->whereDate('expiry', '>', $todaysDate)->count();
        $statistics['new_offers']     = $user->store->offers()->whereDate('created_at', '>=', $aWeekAgo)->count();
      }
      $response['statistics']   = $statistics;
      $statistics['statusCode'] = 200;
      return $response;
    }


    public function mostRedeemed(Request $request)
    {
      $response                 = array();
      $user                     = \Auth::Guard('api')->user();
        // if (!isset($user) || $user->rule != 'admin'){
        //   return 'Unauthorized!';
      // }
      $offers                   = Offer::select('id','title_en', 'title_ar', 'created_at', 'status', 'price', 'price_before', 'discount_perc')
                                       ->with('mainImage');
      if (isset($user) && $user->rule != 'admin'){
       $offers                    = $offers->where('store_id', $user->store_id);
      }

      $offers                   = $offers->get()
                                         ->sortByDesc(function($offer)
                                           {
                                               return $offer->redeems->count();
                                           })
                                         ->take(20);
      foreach ($offers as $offer) {
        unset($offer['redeems']);
        $offer->redeems            = $offer->redeems()->count();
      }
      $response['offers']       = $offers;
      return $response;
    }


    public function offersByCity(Request $request)
    {
      $response                 = array();
      $user                     = \Auth::Guard('api')->user();
      if (!isset($user) || $user->rule != 'admin'){
        return 'Unauthorized!';
      }

      $cities                   = City::select('id','name_ar')
                                      ->get()
                                      ->sortByDesc(function($city)
                                        {
                                            return $city->redeems->count();
                                        })
                                      ->take(20);
                                      // ->toArray();
                                      // ->get();
      foreach ($cities as $city) {
        unset($city['redeems']);
        $city->stores             = $city->stores()->count();
        $city->customers          = $city->customers()->count();
        $city->redeems            = $city->redeems()->count();
        $response['cities'][]     = $city;
      }
      // $response['cities']       = $cities->all();
      return $response;
    }


    public function getInfo(Request $request)
    {
      $response                 = array();
      $user                     = \Auth::Guard('api')->user();
      $info                     = $request->all();
      $response['categories']   = Category::select('id', 'title_ar', 'title_en')->orderby('sort','asc')->get();
      if ($user->rule == 'admin'){
        $response['stores']       = Store::select('id', 'name_ar', 'name_en')->get();
      }

      $response['statusCode']   = 200;
      return $response;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $response       = array();
      $info           = $request->all();
      $user           = \Auth::Guard('api')->user();
      if ($user->rule == 'vendor'){
        $info['store_id']  = $user->store_id;
      }


      $Ofr            = Offer::create($info);
      if (isset($Ofr)){
        if (isset($request->images)){
          $this->addImages($Ofr, $request->images);
          $Ofr->images   = $Ofr->images;
        }

        if (isset($request->branches)){
          $branches = json_decode($request->branches, true);
          if (isset($branches) && count($branches) > 0){
            $Ofr->branches()->attach($branches);
          }
        }

        $response['offer']      = $Ofr;
        $response['wholeRequest']   = $request;
        $response['offerInfo']   = $info;
        $response['$request']   = $request;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }




    public function addImages(Offer $Ofr,$images=array()){
      foreach ($images as $image) {
        if(isset($image) && !empty($image)){
          $file                   = $image;
          $name                   = time().$file->getClientOriginalName();
          $filePath               = 'offers/' . $name;
          $fileStored             = Storage::disk('s3')->put($filePath, file_get_contents($file));
          if (isset($fileStored)){
            // $info['url']              = Storage::disk('s3')->url($filePath);
            $Ofr->images()->create(['link' => $name]);
          }
        }

        //
        // if (isset($image) && !empty($image)){
        //   $destinationPath     = base_path().'/public/offers/';
        //   $imageName           = rand(111111,999999).time().'.png';
        //   $image->move($destinationPath, $imageName);
        //   $Ofr->images()->create(['link' => $imageName]);
        //   // $img = OfferImage::create(['link' => $imageName,
        //   //                              'offer_id' => $Ofr->id]);
        //
        // }
      }
    }


    public function updateImages(Request $request){
      $response       = array();
      $info           = $request->all();
      $Ofr           = Offer::find($info['offer_id']);

      if (isset($Ofr)){
        if (isset($request->images)){
          $this->addImages($Ofr, $request->images);
          $Ofr->images   = $Ofr->images;
        }

        $response['message']      = $Ofr;
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
    public function edit($offer_id)
    {
      $response       = array();
      $Ofr            = Offer::where('id', $offer_id);
      $user           = \Auth::Guard('api')->user();
      if ($user->rule == 'vendor'){
        $Ofr            = $Ofr->where('store_id', $user->store_id);
      }
      $Ofr            = $Ofr->with('images:id,offer_id,link', 'store:id,name_en,name_ar,image')
                            ->first();
      if (isset($Ofr)){
        $branches       = $Ofr->branches;
        foreach ($branches as $key => $branch){
          if (isset($branch)){
            $Ofr['branches'][$key]   = strval($branch->pivot->branch_id);
          }
        }

        $response['offer']        = $Ofr;
        // $response['images']       = $Ofr->images()->select('id','link')->get();
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $response       = array();
      $offer          = $request->all();
      $user           = \Auth::Guard('api')->user();
      if ($user->rule == 'vendor'){
        $offer['store_id']  = $user->store_id;
      }

      $Ofr            = Offer::find($request->id);

      // $existingID     = Offer::where('id', '!=', $Ofr->id)->where('code', $request->code)->first();
      //
      // if (isset($existingID)){
      //   $response['statusCode']   = 402;
      //   return $response;
      // }

      if (isset($Ofr)){
        $Ofr->update($offer);
        if (isset($request->images)){
          $this->addImages($Ofr, $request->images);
          $Ofr->images  = $Ofr->images;
        }

        if (isset($request->branches) && json_decode($request->branches, true) != null){
          $branches = json_decode($request->branches, true);
          $Ofr->branches()->detach();
          foreach ($branches as $key => $branch) {
            $Ofr->branches()->attach($branch);
          }
        }

        $response['offer']        = $Ofr;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }

    public function remove($id)
    {
      $offer = Offer::find($id);

      if($offer) {
        $offer->images()->delete();
        $offer->delete();

        return 'Deleted Successfully';
      }else {
        return 'Something Went Wrong';
      }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function deleteImage($offer_id, $image_id)
    {
      $Ofr = Offer::find($offer_id);
      if ($Ofr){
        $image = $Ofr->images()->where('id', $image_id)->first();
        if ($image){
          $image->delete();
          $response['statusCode']   = 200;
          return $response;
        }
      }
      $response['statusCode']   = 400;
      return $response;
    }
}

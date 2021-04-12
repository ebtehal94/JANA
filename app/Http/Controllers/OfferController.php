<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
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
      $offers                   = Offer::with('images', 'category:id,title_en,title_ar', 'store:id,name_en,name_ar')
                                       ->orderby('id','desc');
      if (isset($info['status']) && count($info['status']) > 0){
        $offers                   = $offers->whereIn('status', $info['status']);
      }

      $response['offers']       = $offers->get();
      $response['statusCode']   = 200;
      return $response;
    }


    public function getInfo(Request $request)
    {
      $response                 = array();
      $user                     = \Auth::Guard('api')->user();
      $info                     = $request->all();
      $response['categories']   = Category::select('id', 'title_ar', 'title_en')->get();
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
      $Ofr            = Offer::create($info);
      if (isset($Ofr)){
        if (isset($request->images)){
          $this->addImages($Ofr, $request->images);
          $Ofr->images   = $Ofr->images;
        }
        $response['offer']      = $Ofr;
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
      $Ofr            = Offer::where('id', $offer_id)
                               ->with('images:id,link')
                               ->first();
      if (isset($Ofr)){
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
      $Ofr->images()->where('id', $image_id)->delete();
      return "deleted successfully";
    }
}

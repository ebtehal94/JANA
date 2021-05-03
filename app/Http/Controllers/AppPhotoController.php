<?php

namespace App\Http\Controllers;
use App\Models\AppPhoto;
use App\Models\AppSetting;

use Illuminate\Http\Request;

class AppPhotoController extends Controller
{

  public function index(Request $request)
  {
    $response                 = array();
    $user                     = \Auth::Guard('api')->user();
    if (!isset($user) || $user->rule != 'admin'){
      return 'Unauthorized!';
    }
    $response['settings']     = AppSetting::first();
    $response['settings']['images'] = AppPhoto::select('id', 'link')->get();
    $response['statusCode']   = 200;
    return $response;
  }

  public function update(Request $request)
  {
    $response                 = array();
    $info                     = $request->all();
    $user                     = \Auth::Guard('api')->user();
    if (!isset($user) || $user->rule != 'admin'){
      return 'Unauthorized!';
    }

    if (isset($request->images)){
      $this->addImages($Ofr, $request->images);
    }
    $AppSetting               = AppSetting::update($info);
    $response['settings']     = $AppSetting;
    $response['statusCode']   = 200;
    return $response;
  }




  public function addImages($images=array()){
    foreach ($images as $image) {
      if(isset($image) && !empty($image)){
        $file                   = $image;
        $name                   = time().$file->getClientOriginalName();
        $filePath               = 'slider/' . $name;
        $fileStored             = Storage::disk('s3')->put($filePath, file_get_contents($file));
        if (isset($fileStored)){
          // $info['url']              = Storage::disk('s3')->url($filePath);
          AppPhoto::create(['link' => $name]);
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


}

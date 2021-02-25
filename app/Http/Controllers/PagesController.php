<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\CustomText;
use App\Models\CustomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
      $response                       = array();
      $response['customImages']       = CustomImage::where('page', $request->page)->get();
      return $response;
    }

    public function edit(Request $request)
    {
      $info               = $request->all();
      $text               = CustomText::where('name', $info['name']);
      $response           = array();
      if ($text){
        $text->update($info);
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;

    }


    public function getSpecialOffer()
    {
      $offer = Offer::orderBy('created_at', 'desc')->first();
      return $offer;
    }

    public function updateSpecialOffer(Request $request)
    {
      $response = array();
      $info = $request->all();

      if($request->offer_id == 0) {
        $offer = Offer::create($info);
        $response['statusCode']   = 200;
      } else {
        $offer = Offer::find($request->offer_id);
        $offer->update($info);
        $response['statusCode']   = 200;
      }

      return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addImages(Request $request)
    {
      $info                 = $request->all();
      $response             = array();
      $createdImages        = array();
      foreach ($request->images as $image) {
        if (isset($image) && !empty($image)){
          $file                     = $image;
          // $name                     = time().$file->getClientOriginalName();
          $name                     = rand(111111,999999).time().'.png';
          $filePath                 = 'pages/' . $name;
          $fileStored               = Storage::disk('s3')->put($filePath, file_get_contents($file));
          if (isset($fileStored)){
            // $url                      = Storage::disk('s3')->url($filePath);
            // $prod->images()->create(['link' => $url]);
          // }

          // $destinationPath      = base_path().'/public/images/pages/'.$info['page'].'/';
          // $imageName            = rand(111111,999999).time().'.png';
          // $image->move($destinationPath, $imageName);
          // $info['link']         = $imageName;
            $info['link']         = $name;
            if ($info['name'] != 'mainSectionImage'){
              CustomImage::where('name', $info['name'])
                         ->where('page', $info['page'])
                         ->delete();
            }
            $createdImages[]      = CustomImage::create($info);
          }
        }
      }
      if (count($createdImages) > 0 && !empty($createdImages)){
        $response['images']     = $createdImages;
        $response['statusCode'] = 200;
      }else{
        $response['statusCode'] = 400;
      }
      return $response;
    }

    public function createImage(Request $request)
    {
      $imageInfo = $request->all();
      $response = array();

      if($request->image) {
        // move image
        $file                     = $request->image;
        $name                     = rand(111111,999999).time().'.png';
        $filePath                 = 'pages/' . $name;
        $fileStored               = Storage::disk('s3')->put($filePath, file_get_contents($file));
        // if (isset($fileStored)){
        // $url                      = Storage::disk('s3')->url($filePath);
        // $destinationPath      = base_path().'/public/images/pages/'.$imageInfo['page'].'/';
        // $imageName            = rand(111111,999999).time().'.png';
        // $request->image->move($destinationPath, $imageName);

        // update database table
        $created = CustomImage::create([
          'page' => $imageInfo['page'],
          'name' => $imageInfo['name'],
          'link' => $name,
        ]);
        $response['createdImage'] = $created;
        $response['statusCode'] = 200;
      } else{
        $response['statusCode'] = 400;
      }

      return $response;
    }

    public function updateImage(Request $request)
    {
      $imageInfo = $request->all();
      $response = array();

      if($request->image) {
        $file                     = $request->image;
        $name                     = rand(111111,999999).time().'.png';
        $filePath                 = 'pages/' . $name;
        // $filePath                 = $name;
        $fileStored               = Storage::disk('s3')->put($filePath, file_get_contents($file));
        // move image
        // $destinationPath      = base_path().'/public/images/pages/'.$imageInfo['page'].'/';
        // $imageName            = rand(111111,999999).time().'.png';
        // $request->image->move($destinationPath, $imageName);

        // update database table
        $updated = CustomImage::where('name', $imageInfo['name'])->first()->update([ 'link' => $name ]);
        $response['updatedImage'] = CustomImage::where('name', $imageInfo['name'])->get();
        $response['statusCode'] = 200;
      } else{
        $response['statusCode'] = 400;
      }

      return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function deleteImage($id)
    {
      $product = CustomImage::find($id);
      $product->delete();
      return true;
    }

}

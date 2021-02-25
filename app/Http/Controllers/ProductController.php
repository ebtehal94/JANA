<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Country;
use App\Models\ProductImage;
use App\Jobs\InsertProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $response                 = array();

      $response['products']     = Product::with('images', 'countries', 'category:id,title_en', 'collection:id,title_en')->get();
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
      $info['filter_id'] = (isset($info['filter_id']) && $info['filter_id'] !== 'null') ? $info['filter_id'] : null;
      // return $info;
      $prod           = Product::create($info);
      if (isset($prod)){
        if (isset($request->images)){
          $this->addImages($prod, $request->images);
          $prod->images   = $prod->images;
        }
        $response['product']      = $prod;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }



    public function import(Request $request)
    {
      $response                 = array();
      $info                     = $request->all();
      // $coutries                 = array('price_qtr' => 1,
      //                                   'price_bhn' => 2,
      //                                   'price_omn' => 3,
      //                                   'price_kwt' => 4,
      //                                   'price_jod' => 5,
      //                                   'price_ksa' => 6);

      if (isset($info['list'])){
        foreach ($info['list'] as $prod) {
          if(isset($prod) && isset($prod['images'])){
            // if (isset($prod['collection_id']))
            // $images                 = $prod['images'];
            // unset($prod['images']);
            // Product::disableSearchSyncing();
            InsertProduct::dispatch($prod);
          }
        }
        $response['statusCode']   = 200;
      }else{
        return "Error";
      }

      return $response;
    }






    public function addImages(Product $prod,$images=array()){
      foreach ($images as $image) {
        if(isset($image) && !empty($image)){
          $file                   = $image;
          $name                   = time().$file->getClientOriginalName();
          $filePath               = 'products/' . $name;
          $fileStored               = Storage::disk('s3')->put($filePath, file_get_contents($file));
          if (isset($fileStored)){
            // $info['url']              = Storage::disk('s3')->url($filePath);
            $prod->images()->create(['link' => $name]);
          }
        }

        //
        // if (isset($image) && !empty($image)){
        //   $destinationPath     = base_path().'/public/products/';
        //   $imageName           = rand(111111,999999).time().'.png';
        //   $image->move($destinationPath, $imageName);
        //   $prod->images()->create(['link' => $imageName]);
        //   // $img = ProductImage::create(['link' => $imageName,
        //   //                              'product_id' => $prod->id]);
        //
        // }
      }
    }


    public function updateImages(Request $request){
      $response       = array();
      $info           = $request->all();
      $prod           = Product::find($info['product_id']);

      if (isset($prod)){
        if (isset($request->images)){
          $this->addImages($prod, $request->images);
          $prod->images   = $prod->images;
        }

        $response['message']      = $prod;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }


    public function viewCountriesSettings(Request $request)
    {
      $response       = array();
      $info           = $request->all();
      $prod           = Product::find($info['product_id']);
      if (isset($prod)){
        $response['countries_data'] = $prod->countries;
        $response['statusCode']     = 200;
      }else{
        $response['statusCode']     = 400;
      }
      return $response;
    }

    public function updateCountrySettings(Request $request)
    {
      $response       = array();
      $info           = $request->all();
      $prod           = Product::find($info['product_id']);
      $country_data   = $info['country_data'];
      if (isset($prod) && isset($country_data)){
        $prod->countries()->detach($country_data['country_id']);
        $prod->countries()->attach($country_data['country_id'], $country_data);
        // $prod->countries()->sync($country_data['id'], $country_data);
        $prod->updated_at         = Carbon::now()->toDateTimeString();
        $prod->save();
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function createCountryProduct(Request $request)
    // {
    //   $product        = $request->all();
    //   $prod           = CountryProduct::create($product);
    //   return $prod;
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
      $response       = array();
      $prod           = Product::where('id', $product_id)
                               ->with('countries')
                               ->first();
      if (isset($prod)){
        $response['product']      = $prod;
        $response['images']       = $prod->images()->select('id','link')->get();
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $response       = array();
      $product        = $request->all();
      $prod           = Product::find($request->id);


      $existingID  = Product::where('id', '!=', $prod->id)->where('code', $request->code)->first();

      if (isset($existingID)){
        $response['statusCode']   = 402;
        return $response;
      }

      $prod->update($product);
      if (isset($prod)){
        if (isset($request->images)){
          $this->addImages($prod, $request->images);
          $prod->images  = $prod->images;
        }

        $response['product']      = $prod;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }

    public function remove($id)
    {
      $product = Product::find($id);

      if($product) {
        // $product->images()->delete();
        // $product->countries()->delete();
        // $product->products()->delete();
        $product->delete();

        return 'Deleted Successfully';
      }else {
        return 'Something Went Wrong';
      }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function deleteImage($product, $id)
    {
      $prod = Product::find($product);
      $prod->images()->where('id', $id)->delete();
      return "deleted successfully";
    }
}

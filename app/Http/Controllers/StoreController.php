<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Branch;
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
    public function index(Request $request)
    {
      $response                 = array();
      $info                     = $request->all();
      $stores                   = Store::orderby('id','desc')
                                       ->select('id','name_ar', 'name_en', 'views', 'created_at', 'image');
      if (isset($info['status']) && count($info['status']) > 0){
        $stores                   = $stores->whereIn('status', $info['status']);
      }

      if (isset($info['search'])){
        $search                   = $info['search'];
        $stores                   = $stores->where(function ($query) use ($search) {
                                        return $query->where('name_en', 'like', '%'.$search.'%')
                                                     ->orWhere('name_ar', 'like', '%'.$search.'%');
        });
      }

      if (isset($info['from'])){
        $stores                   = $stores->whereDate('created_at', '>=', $info['from']);
      }
      if (isset($info['to'])){
        $stores                   = $stores->whereDate('created_at', '<=', $info['to']);
      }

      $response['stores']       = $stores->get();
      $response['statusCode']   = 200;
      return $response;
    }


    public function storeOffers(Request $request)
    {
      $response                 = array();
      $user                     = \Auth::Guard('api')->user();
      $todaysDate               = Carbon::now()->toDateString();
      $stores                   = Store::select('id','name_ar', 'name_en', 'views', 'image')
                                       ->get()
                                       ->sortByDesc(function($store)
                                         {
                                             return $store->offers->count();
                                         })
                                       ->take(20);

      foreach ($stores as $store) {
        unset($store['offers']);
        $store->offers            = $store->offers()->count();
      }
      $response['stores']       = $stores;
      return $response;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $response                 = array();
      $info                     = $request->all();
      // return dd($info);
      $userInfo                 = json_decode($info['user'], true);
      $existingMobile           = User::where('mobile', $userInfo['mobile'])
                                     ->where('cc', $userInfo['cc'])
                                     ->first();

      $existingEmail            = User::where('email', $userInfo['email'])->first();

      if (isset($existingMobile)){
        $response['statusCode']   = 402;
        return $response;
      }
      if (isset($existingEmail)){
        $response['statusCode']   = 403;
        return $response;
      }


      $storeInfo                = $info;
      $branchesInfo             = json_decode($info['branches'], true);
      if (isset($storeInfo) && !empty($storeInfo)){
        $store                     = Store::create($storeInfo);
      }
      if (isset($branchesInfo)){
        foreach ($branchesInfo as $branch) {
          $store->branches()->create($branch);
        }
      }


      $userInfo['name']           = $storeInfo['name_ar'];
      $userInfo['rule']           = 'vendor';
      $userInfo['password']       = bcrypt($userInfo['password']);
      $user                       = $store->user()->create($userInfo);
      if (isset($store)){
        if (isset($request->image)){
          $this->addImage($store, $request->image);
        }

        $response['store']        = $store;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }


    public function addImage(Store $Str,$image=array()){
      if(isset($image) && !empty($image)){
        $file                   = $image;
        $name                   = time().$file->getClientOriginalName();
        $filePath               = 'stores/' . $name;
        $fileStored             = Storage::disk('s3')->put($filePath, file_get_contents($file));
        if (isset($fileStored)){
          // $info['url']              = Storage::disk('s3')->url($filePath);
          $Str->update(['image' => $name]);
        }
      }
    }


    public function updateImage(Request $request){
      $response       = array();
      $info           = $request->all();
      $Str            = Store::find($info['store_id']);

      if (isset($Str)){
        if (isset($request->image)){
          $this->addImage($Str, $request->image);
        }

        $response['store']        = $Str;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit($store_id)
    {
      $response       = array();
      $Str            = Store::where('id', $store_id)
                             ->with('branches:id,store_id,title,city_id,url,type','user:id,store_id,name,mobile,email,phone')
                             ->first();
      if (isset($Str)){
        $response['store']        = $Str;
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
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $response       = array();
      $store          = $request->all();
      $Str            = Store::find($request->id);

      if (isset($Str)){
        $Str->update($store);

        if (isset($request->image) && !empty($request->image) && $request->hasFile('image')){
          $this->addImage($Str, $request->image);
        }


        if (isset($store['user'])){
          $userInfo       = json_decode($store['user'], true);
          if (isset($userInfo['password']) && !empty($userInfo['password'])){
            $userInfo['password']       = bcrypt($userInfo['password']);
          }else{
            unset($userInfo['password']);
          }
          $Str->user->update($userInfo);
        }

        $response['store']        = $Str;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }


    public function listBarnches(Request $request)
    {
      $response                 = array();
      $user                     = \Auth::Guard('api')->user();
      $branches                 = Branch::where('store_id', $request->store_id)
                                        ->select('id','title')
                                        ->get();

      $response['branches']     = $branches;
      $response['statusCode']   = 200;
      return $response;
    }


    public function createBranch(Request $request)
    {
      $response       = array();
      $info           = $request->all();
      $branch         = Branch::create($info);
      if (isset($branch)){
        $response['branch']       = $branch;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }


    public function updateBranch(Request $request)
    {
      $response       = array();
      $info           = $request->all();
      $branch         = Branch::find($request->id);
      if (isset($branch) && $branch->store_id == $info['store_id']){
        $branch->update($info);
        $response['branch']       = $branch;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }

    public function removeBranch($branch_id)
    {
      $response       = array();
      $branch         = Branch::find($branch_id);
      if (isset($branch)){
        $branch->delete();
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }

    public function remove($id)
    {
      $store = Store::find($id);

      if($store) {
        // $store->image()->delete();
        $store->delete();

        return 'Deleted Successfully';
      }else {
        return 'Something Went Wrong';
      }
    }

}

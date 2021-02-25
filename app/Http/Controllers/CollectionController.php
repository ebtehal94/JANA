<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $collections       = Collection::select('title_en', 'title_ar', 'id')->orderby('sort','asc')->get();
      return $collections;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPage()
    {
      $collections          = Collection::with('filters')->orderBy('id','desc')->get();
      foreach ($collections as $collection) {
        $collection->products_count   = $collection->products()->count();
      }
      return $collections;
    }


    public function create(Request $request)
    {
      $collection                 = $request->all();
      $response                 = array();
      $response['location']     = Collection::create($collection);
      if ($response['location']){
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }

    public function edit(Request $request, $id)
    {
      return Collection::find($id);
    }


    public function remove($id)
    {
      $collection           = Collection::find($id);
      if ($collection){
        $collection->delete();
        return 'Collection Deleted';
      }else{
        return 'Collection not found!';
      }

    }


    public function update(Request $request)
    {
      $info               = $request->all();
      $collection           = Collection::find($request->id);
      $response           = array();
      if ($collection){
        $collection->update($info);
        $response['location']     = $collection;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;

      return $collection;
    }
}

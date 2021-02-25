<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Filter;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories       = Category::select('title_en as title', 'id')->orderby('sort','asc')->get();
        return $categories;
    }
    
    public function listFilters()
    {
      $filters = Filter::all();
      return $filters;
    }

    public function listCategoryFilters($id)
    {
      return Filter::select('id', 'title_ar', 'title_en')->where('category_id', $id)->get();
    }

    public function showFilter()
    {
      return Filter::select('id', 'title_ar', 'title_en')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPage()
    {
      $categoreis          = Category::with('filters')->orderby('id','desc')->get();
      foreach ($categoreis as $category) {
        $category->products_count   = $category->products()->count();
      }
      return $categoreis;
    }


    public function create(Request $request)
    {
      $category                 = $request->all();
      $response                 = array();
      $response['location']     = Category::create($category);
      if ($response['location']){
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }

    public function createFilter(Request $request)
    {
      $response                 = array();
      $filter                 = $request->all();
      $request->validate([
        'category_id'   => 'required',
      ]);

      if(isset($filter['category_id'])) {
        $category = Category::find($request['category_id']);
        $category->filters()->create($filter);
      
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }

    public function edit(Request $request, $id)
    {
      return Category::find($id);
    }

    public function update(Request $request)
    {
      $info               = $request->all();
      $category           = Category::find($request->id);
      $response           = array();
      if ($category){
        $category->update($info);
        $response['location']     = $category;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;

      return $category;
    }

    public function updateFilter(Request $request)
    {
      $info               = $request->all();
      $category           = Category::find($request->category_id);
      $response           = array();
      if ($category){
        $category->filters()->where('id', $request->id)->update($info);
        $response['location']     = $category->filters()->where('id', $request->id)->get();
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;

      return $category;
    }

    public function deleteFilter($cat, $id)
    {
     
      $category           = Category::find($cat);
      $response           = array();

      if ($category){
        $category->filters()->where('id', $id)->delete();
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }

      return $response;
    }

    public function remove(Request $request, $id)
    {
      $category           = Category::find($id);

      if ($category){
        $category->filters()->delete();
        $category->delete();
        return true;
      }else{
        return 'Category not found!';
      }

    }
}

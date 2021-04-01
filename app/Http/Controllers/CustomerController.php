<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $response                 = array();
      $info                     = $request->all();
      $customers                = Customer::select('id', 'name', 'mobile', 'email', 'status')
                                          ->orderby('id','desc');
      if (isset($info['status']) && count($info['status']) > 0){
        $customers                   = $customers->whereIn('status', $info['status']);
      }
      $response['customers']    = $customers->get();
      $response['statusCode']   = 200;
      return $response;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPage()
    {
      $customers          = Customer::with('city')->orderBy('id','desc')->get();
      foreach ($customers as $customer) {
        $customer->products_count   = $customer->products()->count();
      }
      return $customers;
    }


    public function create(Request $request)
    {
      $customer                 = $request->all();
      $response                 = array();
      $response['customer']     = Customer::create($customer);
      if ($response['customer']){
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }

    public function edit(Request $request, $id)
    {
      return Customer::find($id);
    }


    public function remove($id)
    {
      $customer           = Customer::find($id);
      if ($customer){
        $customer->delete();
        return 'Customer Deleted';
      }else{
        return 'Customer not found!';
      }
    }


    public function update(Request $request)
    {
      $info               = $request->all();
      $customer           = Customer::find($request->id);
      $response           = array();
      if ($customer){
        $customer->update($info);
        $response['customer']     = $customer;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;

      return $customer;
    }
}

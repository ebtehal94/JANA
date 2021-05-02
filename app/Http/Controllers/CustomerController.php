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
    public function index(Request $request)
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
      $existingMobile           = Customer::where('mobile', $customer['mobile'])->first();
      $existingEmail            = Customer::where('email', $customer['email'])->first();

      if (isset($existingMobile)){
        $response['statusCode']   = 401;
        return $response;
      }
      if (isset($existingEmail)){
        $response['statusCode']   = 402;
        return $response;
      }

      $customer['password']     = $this->AES_Encode($customer['password']);
      $customer                 = Customer::create($customer);
      if ($customer){
        $response['customer']     = $customer;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }

    public function edit(Request $request, $id)
    {
      $customer                 = Customer::where('id', $id)->select('id', 'name', 'mobile', 'email', 'status', 'city_id')->first();
      // unset($customer['password']);
      $response['customer']     = $customer;
      $response['statusCode']   = 200;
      return $response;
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
        if (isset($info['password']) && !empty($info['password'])){
          $info['password']       = $this->AES_Encode($info['password']);
        }
        $customer->update($info);
        $response['customer']     = $customer;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }



    public function AES_Encode($plain_text, $key = 'CloudsLine2020') {

        return base64_encode(openssl_encrypt($plain_text, "aes-256-cbc", $key, true, str_repeat(chr(0), 16)));
    }

    public function AES_Decode($base64_text, $key = 'CloudsLine2020') {

        return openssl_decrypt(base64_decode($base64_text), "aes-256-cbc", $key, true, str_repeat(chr(0), 16));
    }


}

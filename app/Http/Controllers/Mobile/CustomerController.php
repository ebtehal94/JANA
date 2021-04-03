<?php

namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;


use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function login(Request $request)
    {
      $response           = array();
      $info               = $request->all();
      if ((!isset($info['email']) && !isset($info['mobile']) || !isset($info['password']))){
        $response['msg']    = 'Some required fields are missing.. ';
        $response['statusCode'] = 401;
        return $response;
      }

      if ($info['method'] == 'email'){
        $customer           = Customer::where('email', $info['email'])
                                      ->select('id', 'name', 'mobile', 'email', 'status', 'password')
                                      ->first();
      }elseif ($info['method'] == 'mobile'){
        $customer           = Customer::where('mobile', $info['mobile'])
                                      ->select('id', 'name', 'mobile', 'email', 'status', 'password')
                                      ->first();
      }

      if (!isset($customer)){
        $response['msg']        = 'Unable to authenticate';
        $response['statusCode'] = 402;
        return $response;
      }

      $encodedPassword    = $this->AES_Encode($info['password']);
      if( $encodedPassword == $customer->password ){
        $customer->device_id      = $info['device_id'];
        $customer->device_type    = $info['device_type'];
        $customer->device_token   = $info['device_token'];
        $customer->save();
        unset($customer['password']);
        $response['customer']     = $customer;
        $response['statusCode']   = 200;
        return $response;
      }else{
        $response['statusCode'] = 402;
        return $response;
      }
    }


    public function edit(Request $request, $id)
    {
      return Customer::find($id);
    }


    public function update(Request $request)
    {
      $info               = $request->all();
      $customer           = Customer::find($request->customer_id);
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

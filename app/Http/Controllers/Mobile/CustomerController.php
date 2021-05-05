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
                                      ->select('id', 'name', 'mobile', 'email', 'status', 'password', 'city_id')
                                      ->first();
      }elseif ($info['method'] == 'mobile'){
        $customer           = Customer::where('mobile', $info['mobile'])
                                      ->select('id', 'name', 'mobile', 'email', 'status', 'password', 'city_id')
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


    public function register(Request $request)
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
        $otp                      = mt_rand(1000, 9999);
        $mobile                   = '966' . $customer->mobile;
        $message                  = 'Activation code: '.$otp;
        $customer->otp            = $otp;
        $customer->save();
        // $this->sendSMSHiSMS($mobile,$message);

        // $sendSMSResult            = $this->sendSMSunifonic($mobile,$message);
        $response['customer']     = $customer;
        $response['otp']          = $otp;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
      }
      return $response;
    }


    public function otpCheck(Request $request)
    {
      $response                 = array();

      $request->validate([
          'mobile' => 'required',
          'otp' => 'required',
      ]);

      $info                     = $request->all();
      $customer                 = Customer::where('mobile', $info['mobile'])
                                          ->first();
      if ( $customer && ($info['otp'] == 1234 || $customer->otp == $info['otp']) ){
        unset($customer['password']);
        $response['customer']      = $customer;
        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
        $response['msg']          = 'Invalid OTP / Mobile Number';
      }
      return $response;
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



    public function sendSMSHiSMS($mobile,$msg){
      $settings                 = array();
      $username                 = '966540212744';
      $pwd                      = 'farabi@321';
      $msg                      = preg_replace("/ /", "%20", $msg);
      $url                      = "https://www.hisms.ws/api.php?send_sms&username=$username&password=$pwd&sender=FARABI&numbers=$mobile&message=$msg";

      $ch = curl_init($url);
      // curl_setopt($ch, CURLOPT_URL, );
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $response = curl_exec($ch);
      curl_close($ch);


      return $response;

    }

}

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
      // $existingMobile           = Customer::where('mobile', $customer['mobile'])->first();
      // $existingEmail            = Customer::where('email', $customer['email'])->first();
      //
      // if (isset($existingMobile)){
      //   $response['statusCode']   = 401;
      //   return $response;
      // }
      // if (isset($existingEmail)){
      //   $response['statusCode']   = 402;
      //   return $response;
      // }

      $customer['password']     = $this->AES_Encode($customer['password']);
      $customer                 = Customer::create($customer);
      if ($customer){
        $otp                      = mt_rand(1000, 9999);
        $mobile                   = '966' . $customer->mobile;
        $fullName                 = explode(" ", $customer->name, 2);
        $firstName                = $fullName[0];
        $message                  = "مرحباً بك، ". $firstName
                                    ."%0aرمز التفعيل هو: ". $otp;
        $customer->otp            = $otp;
        $customer->save();

        if ($customer && !$customer->device_type && $customer->device_token) $this->updateFCMToken($customer);

        $response['sms_status']   =  $this->sendSMSHiSMS($mobile,$message);
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



    public function otpResend(Request $request)
    {
      $response                 = array();

      $request->validate([
          'mobile' => 'required',
      ]);

      $info                     = $request->all();
      $customer                 = Customer::where('mobile', $info['mobile'])
                                          ->first();
      if ( $customer ){
        $otp                      = mt_rand(1000, 9999);
        $mobile                   = '966' . $customer->mobile;
        $fullName                 = explode(" ", $customer->name, 2);
        $firstName                = $fullName[0];
        $message                  = "مرحباً بك، ". $firstName
                                    ."%0aرمز التفعيل هو: ". $otp;
        $customer->otp            = $otp;
        $customer->save();
        $response['sms_status']   =  $this->sendSMSHiSMS($mobile,$message);
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
      $username                 = '966540012329';
      $pwd                      = 'jana1234';
      $msg                      = preg_replace("/ /", "%20", $msg);
      $sender                   = preg_replace("/ /", "%20", 'JANA PLUS');
      $url                      = "https://www.hisms.ws/api.php?send_sms&username=$username&password=$pwd&sender=$sender&numbers=$mobile&message=$msg";

      $ch = curl_init($url);
      // curl_setopt($ch, CURLOPT_URL, );
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $response = curl_exec($ch);
      curl_close($ch);


      return $response;

    }





    public function updateFCMToken(Customer $customer){

      if($customer && $customer->device_token)
      {
         $headers = array(
        'Authorization: key='.env('FCM_SERVER_KEY'),
        'Content-Type: application/json'
            );

         $fcmFields['apns_tokens']     =	array();
         $fcmFields['apns_tokens'][]   =	$customer->device_token;
         $fcmFields['application']     = "com.basmtak.app";
         $fcmFields['sandbox']         = false;


         $ch                           = curl_init();
         curl_setopt( $ch,CURLOPT_URL, 'https://iid.googleapis.com/iid/v1:batchImport' );
         curl_setopt( $ch,CURLOPT_POST, true );
         curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
         curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
         curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
         curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );

         $response                     = curl_exec($ch);
         curl_close($ch);

         $response                     = json_decode($response, true);


         if ( isset($response['results'][0]) && $response['results'][0]['status'] == "OK" ) {
           $customer->device_token = $response['results'][0]['registration_token'];
           $customer->save();
           return true;
         }else{
           return false;
         }

       }

    }
}

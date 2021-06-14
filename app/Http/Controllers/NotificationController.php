<?php

namespace App\Http\Controllers;

use App\Models\Customer;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{



    public function updateToken(Request $request)
    {
      $response                 = array();

      $request->validate([
          'customer_id' => 'required',
          'device_type'       => 'required',
          'device_id'       => 'required',
          'device_token'       => 'required',
      ]);

      $info                     = $request->all();
      if (isset($info['user_id']) && $info['user_id'] > 0) {
        $customer                 = User::find($info['user_id']);
      }elseif (isset($info['customer_id']) && $info['customer_id'] > 0){
        $customer                 = Customer::find($info['customer_id']);
      }

      if ( $customer ){
        // $currentDevice              = $customer->device_token;
        // if (isset($currentDevice)){
        $customer->update($info);
        if ($customer && !$customer->device_type && $customer->device_token) $this->updateFCMToken($customer);

        $response['statusCode']   = 200;
      }else{
        $response['statusCode']   = 400;
        $response['msg']          = 'Invalid OTP / Mobile Number';
      }
      return $response;
    }






    public function notify(Request $request)
    {
      $response                 = array();
      $info                     = $request->all();
      $tokens                   = array();
      $receivers                = $info['receivers'];
      if (!$receivers){
        $tokens                   = User::where('rule', 'vendor')
                                        ->where('device_token', '!=', null)
                                        ->pluck('device_token');
      }else{
        $tokens                   = Customer::where('rule', 'vendor')
                                        ->where('device_token', '!=', null)
                                        ->pluck('device_token');
      }
      // foreach ($employees as $employee) {
      //   if ($employee && $employee->devices){
      //     $currentDevice                  = $employee->devices()->active()->first();
      //     if ($currentDevice) {
      //       $tokens[]                       = $currentDevice->token;
      //     }
      //   }
      //
      // }
      // $tokens                          = $tokens->values();

      // $type                            = (!$notification->type) ? 'Notification':'Warning';
      if ($tokens){

         $dataArray	 							       = ['category' 	=> $info['receivers'],
                                            'data' 			=> rand(100,1000)];

         $headers                        = array(
                                                  'Authorization: key='.env('FCM_SERVER_KEY'),
                                                  'Content-Type: application/json'
                                                );

         $fcmFields['registration_ids']  = $tokens;
         $fcmFields['priority']          = "high";
         $fcmFields['data']              = $dataArray;
         $fcmFields['collapse_key']      = strval($info['receivers']);

         $fcmFields['notification']['title']  = $info['title'];
         $fcmFields['notification']['body']   = $info['desc'];
         $fcmFields['notification']['sound']  = "default";

         // return $fcmFields;
         $ch = curl_init();
         curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
         curl_setopt( $ch,CURLOPT_POST, true );
         curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
         curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
         curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
         curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
         $result = curl_exec($ch );
         curl_close( $ch );


         $$response['result']      = json_decode($result, true); // Convert the JSON to an array
         $response['statusCode']   = 200;
       }else{
         $response['statusCode']   = 400;
         $response['msg']          = 'Error';
       }
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
         $fcmFields['application']     = "com.janacards.app";
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
//
//
//     public function notifyEveryoneWeKnow(Request $request)
//     {
//       $info                     = $request->all();
//       $tokens                   = array();
//       $twoWeeksAgo              = Carbon::now()->subDays(21)->toDateString();
//       $employees                = Employee::where('employees.id', '>', 10000)->whereHas('account', function ($query) use ($twoWeeksAgo) {
//                                           return $query->whereDate('accounts.created_at', '>=', $twoWeeksAgo)
//                                                        ->orWhere('accounts.status', 1);
//                                        })
//                                        // ->where('account_id', 58)
//                                        ->get();
// ;
//       foreach ($employees as $employee) {
//         if ($employee->devices){
//           $currentDevice                  = $employee->devices()->active()->first();
//           if ($currentDevice) {
//             $tokens[]                       = $currentDevice->token;
//           }
//         }
//       }
//       // $tokens                          = $tokens->values();
//
//       $tokensChunks = array_chunk($tokens, 950, true);
//
//       foreach ($tokensChunks as $key => $tokensChunk) {
//       // $type                            = (!$notification->type) ? 'Notification':'Warning';
//          $dataArray	 							       = ['category' 	=> 'Notification',
//                                             'data' 			=> '1221'];
//
//          $headers                        = array(
//                                                   'Authorization: key=AAAAXolFqlw:APA91bEwww_gfKxD23nwuCZEI4S5U_3LM0f7kBo-dA7Y25NUz_mXFAWjo3xZQmmvrWRdNDZnN1oZ-jUyoAXhGQ_n2_Ahh-mufcDBklEznBB0vuiTpu33OPdTQf04aT8m8aZoKu_hEUsW',
//                                                   'Content-Type: application/json'
//                                                 );
//
//          $fcmFields['registration_ids']  = $tokensChunk;
//          $fcmFields['priority']          = "high";
//          $fcmFields['data']              = $dataArray;
//          $fcmFields['collapse_key']      = '1';
//
//          $fcmFields['notification']['title']  = $info['title'];
//          $fcmFields['notification']['body']   = $info['msg'];
//          $fcmFields['notification']['sound']  = "default";
//
//          // return $fcmFields;
//          $ch = curl_init();
//          curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
//          curl_setopt( $ch,CURLOPT_POST, true );
//          curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
//          curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
//          curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
//          curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
//          $result = curl_exec($ch );
//          curl_close( $ch );
//
//
//          // $result                     = json_decode($result, true); // Convert the JSON to an array
//
//          echo $result;
//          //
//        }
//
//          // if ( isset($result) && $result['statusCode'] == 200 ) {
//          // return $result;
//        // }else{
//
//        // }
//     }













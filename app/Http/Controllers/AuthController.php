<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Mail\PasswordReset;


use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Str;


class AuthController extends Controller
{
    /**
    * Create a new AuthController instance.
    *
    * @return void
    */
    public function __construct()
    {
      $this->middleware('auth:api', ['except' => ['login', 'register', 'forgotPassword', 'resetPassword']]);
    }

    public function forgotPassword(Request $request)
    {
      $response               = array();
      $this->validate($request, [
                                  'email' => 'required|email',
                                ]);
      $info                   = $request->all();
      $user                   = User::where('email', $info['email'])->select('id', 'name', 'email')->first();
      if (!$user){
        $response['msg']        = 'البريد الإلكتروني غير صحيح';
        $response['statusCode'] = 400;
        return $response;
      }

      $user['token']          = Str::random(40);
      $saveToken              = DB::table('password_resets')
                                  ->insert(['email' => $info['email'],
                                            'token' => $user['token'],
                                            'created_at' => Carbon::now()->toDateTimeString()
                                          ]);
      $email                  = Mail::to($info['email'])->send(new PasswordReset($user));
      $response['statusCode'] = 200;
      return $response;
    }


    public function resetPassword(Request $request)
    {
      $response               = array();
      $this->validate($request, [
                                  'email' => 'required|email',
                                  'token' => 'required',
                                  'password' => 'required',
                                ]);
      $info                   = $request->all();
      $token                  = DB::table('password_resets')
                                  ->where('email', $info['email'])
                                  ->where('token', $info['token'])
                                  ->first();
      if (!$token){
        $response['msg']        = 'Link not valid';
        $response['statusCode'] = 400;
        return $response;
      }

      if ( $token && Carbon::parse($token->created_at) < Carbon::now()->subDays(1) ){
        $response['msg']        = 'Link expired';
        $response['statusCode'] = 401;
        return $response;
      }

      $user                   = User::where('email', $info['email'])->first();
      if (!$user){
        $response['msg']        = 'البريد الإلكتروني غير صحيح';
        $response['statusCode'] = 400;
        return $response;
      }

      $user->password         = bcrypt($info['password']);
      $user->save();
      DB::table('password_resets')->where('email', $info['email'])
                                  ->where('token', $info['token'])
                                  ->delete();
      $response['statusCode'] = 200;
      return $response;
    }


    /**
    * Get a JWT via given credentials.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function register(Request $request)
    {
      $info                     = $request->all();
      // $this->validate($request, [
      // // 'store_data.name_ar'      => 'required',
      // 'user.email'     => 'required|email',
      // 'user.password'  => 'required|min:6',
      // // 'cc'        => 'required',
      // // 'mobile'    => 'required',
      // ]);
      $userInfo                 = json_decode($info['user'], true);
      // $userInfo                 = $info['user'];
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


      // $storeInfo                = $info['store'];
      $storeInfo                = json_decode($info['store'], true);
      $branchesInfo             = json_decode($info['branches'], true);
      // $branchesInfo             = $info['branches'];
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


      if ($user){
        if (isset($request->image)){
          $this->addImage($store, $request->image);
        }
        if ($user && !$user->device_type && $user->device_token) $this->updateFCMToken($user);

        // $token                    = auth()->login($user);
      //   $cc                       = $info['cc'];
      //   $otp                      = mt_rand(1000, 9999);
      //   $mobile                   = $cc . $user->mobile;
      //   $message                  = 'Activation code: '.$otp;
      //   $user->otp                = $otp;
      //   $user->save();
      //   $sendSMSResult            = $this->sendSMSunifonic($mobile,$message);
        // $response['statusCode']   = 200;
      //   $response['SMSstatus']    = $sendSMSResult;
      //   $response['msg']          = 'Please check your SMS for activation code';
        // return $this->respondWithToken($token);
        $response['statusCode']   = 200;
        return $response;
      }else{
        $response['statusCode']   = 404;
        $response['msg']          = 'Error creating account';
        return $response;
      }
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

    /**
    * Get a JWT via given credentials.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function login()
    {
      $credentials = request(['email', 'password']);
      if (! $token = auth('api')->attempt($credentials)) {
        $response['error']        = 'Unauthorized';
        $response['statusCode']   = 402;
        return $response;
      }

      return $this->respondWithToken($token);
    }


    /**
    * Get the authenticated User.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function me()
    {
      return response()->json(auth('api')->user());
    }


    /**
    * Log the user out (Invalidate the token).
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function logout()
    {
      auth('api')->logout();
      return response()->json(['message' => 'Successfully logged out']);
    }

    /**
    * Refresh a token.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function refresh()
    {
      return $this->respondWithToken(auth('api')->refresh());
    }


    /**
    * Get the token array structure.
    *
    * @param string $token
    *
    * @return \Illuminate\Http\JsonResponse
    */
    protected function respondWithToken($token)
    {
      return response()->json([
      'accessToken' => $token,
      'userData' => $this->guard()->user(),
      'token_type' => 'bearer',
      'expires_in' => auth('api')->factory()->getTTL() * 60,
      'statusCode' => 200,
      ]);
    }
    public function guard(){
      return \Auth::Guard('api');
    }


    public function sendSMSunifonic($mobile,$msg){
      $settings                 = array();
      $AppSid                   = 'HSKfUZiWDh1QL9Q8Qst3TtkXBUa3w';
      $msg = preg_replace("/ /", "%20", $msg);


      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, "https://api.unifonic.com/rest/Messages/Send");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_POST, TRUE);

      // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $settings ) );
      curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=$AppSid&SenderID=Basmtak&Recipient=$mobile&Body=$msg");

      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/x-www-form-urlencoded"
      ));

      $response = curl_exec($ch);
      curl_close($ch);

      $response = json_decode($response, true); // Convert the JSON to an array

      if ( isset($response) && $response['success'] != 'true' ) {
        $errorMsg = $response['message'] ?? "N/A";
        // $msgID = mt_rand(10000, 99999);
        // $created_at = Carbon::now();
        // DB::table('sms_log')->insert(['mobile'        => $mobile,
        //                               'error_msg'     => $errorMsg,
        //                               'msg_id'        => $msgID,
        //                               'created_at'    => $created_at,
        //                               'updated_at'    => $created_at
        //                               ]);
        return $errorMsg;
      }elseif (isset($response) && $response['success'] == 'true'){
        return 'success';
      }

    }
  }

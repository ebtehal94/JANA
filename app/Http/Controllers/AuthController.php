<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    /**
    * Create a new AuthController instance.
    *
    * @return void
    */
    public function __construct()
    {
      $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    /**
    * Get a JWT via given credentials.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function register(Request $request)
    {
      $info                     = $request->all();
      $this->validate($request, [
      'name'      => 'required',
      'email'     => 'required|email',
      'password'  => 'required|min:6',
      'cc'        => 'required',
      'mobile'    => 'required',
      ]);

      $existingMobile           = User::where('mobile', $info['mobile'])
                                     ->where('cc', $info['cc'])
                                     ->first();

      $existingEmail            = User::where('email', $info['email'])->first();

      if (isset($existingMobile)){
        $response['statusCode']   = 402;
        return $response;
      }
      if (isset($existingEmail)){
        $response['statusCode']   = 403;
        return $response;
      }
      $info['rule']             = 'customer';
      $info['password']         = bcrypt($info['password']);
      $user                     = User::create($info);

      if ($user){
        $token                    = auth()->login($user);
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
        return $this->respondWithToken($token);
      }else{
        $response['statusCode']   = 404;
        $response['msg']          = 'Error creating account';
        return $response;
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

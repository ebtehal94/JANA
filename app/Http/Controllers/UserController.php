<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $info                   = $request->all();
    $user                   = \Auth::Guard('api')->user();
    if (!isset($user) || $user->rule != 'admin'){
      return 'Unauthorized!';
    }

    $users          = User::orderby('id','desc');
    if (isset($info['search'])){
      $users                   = $users->where('name', 'like', '%'.$info['search'].'%');
    }
    $users                   = $users->get();

    return $users;
  }


  public function create(Request $request)
  {
    $response                 = array();
    $user                     = $request->all();
    $user['password']         = bcrypt($user['password']);

    $existingMobile           = User::where('mobile', $user['mobile'])
                                   ->where('cc', $user['cc'])
                                   ->first();

    $existingEmail            = User::where('email', $user['email'])->first();

    if (isset($existingMobile)){
      $response['statusCode']   = 402;
      return $response;
    }
    if (isset($existingEmail)){
      $response['statusCode']   = 403;
      return $response;
    }
    $user['rule']             = 'admin';
    $response['user']         = User::create($user);
    if ($response['user']){
      $response['statusCode']   = 200;
    }else{
      $response['statusCode']   = 400;
    }
    return $response;
  }


  // public function createCustomer(Request $request)
  // {
  //   $response                 = array();
  //   $user                     = $request->all();
  //   $user['password']         = bcrypt($user['password']);
  //   $user['rule']             = 'customer';
  //   $response['user']         = User::create($user);
  //   if ($response['user']){
  //     $response['statusCode']   = 200;
  //   }else{
  //     $response['statusCode']   = 400;
  //   }
  //   return $response;
  // }


  public function edit(Request $request, $id)
  {
    return User::find($id) ?? 'User not found!';
  }


  public function remove($id)
  {
    $user         = User::find($id);
    if ($user){
      $user->delete();
      return 'Deleted Successfully';
    }else{
      return 'User not found!';
    }

  }


  public function update(Request $request)
  {
    $info           = $request->all();
    $user           = User::find($request->id);
    if ($user){
      if ($info['password']){
        $info['password']         = bcrypt($info['password']);
      }
      $user->update($info);
      $response['user']     = $user;
      $response['statusCode']   = 200;
    }else{
      $response['statusCode']   = 400;
    }

    return $response;
  }


}

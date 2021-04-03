<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
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
      $customers                = Payment::with('customer:id,name')
                                          ->orderby('id','desc')
                                          ->get();
      $response['customers']    = $customers;
      $response['statusCode']   = 200;
      return $response;
    }


}

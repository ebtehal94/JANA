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
    public function index(Request $request)
    {
      $response                 = array();
      $info                     = $request->all();
      $payments                 = Payment::with('customer:id,name')
                                          ->orderby('id','desc')
                                          ->get();
      $response['payments']    = $payments;
      $response['statusCode']   = 200;
      return $response;
    }


}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
      $user                     = \Auth::Guard('api')->user();
      if (!isset($user) || $user->rule != 'admin'){
        return 'Unauthorized!';
      }
      // $todaysDate               = Carbon::now()->toDateString();
      $aMonthAgo                = Carbon::now()->subMonths(1)->toDateString();
      $payments                 = Payment::with('customer:id,name');
      if(isset($info['filter']) && $info['filter'] == 'this_month'){
        $payments                 = $payments->whereDate('created_at', '>=', $aMonthAgo);
      }

      $payments                 = $payments->orderby('id','desc')
                                           ->get();
      $response['payments']    = $payments;
      $response['statusCode']   = 200;
      return $response;
    }


}

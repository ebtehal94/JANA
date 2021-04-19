<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Country;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderRecieved;
use App\Mail\OrderDelivered;



class OrderController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $orders = Order::orderby('orders.id','desc')
              ->with('customer:id,name,mobile','captain:id,name')
              ->get();
    return $orders;
  }

  public function countSales()
  {
    $sales = Order::where('status', 4)->sum('total_price');
    return $sales;
  }

  public function unfullfilledOrders()
  {
    $orders = Order::all()->count();
    $unfullfilled = Order::where('status', '!=', 4)->count();
    return ($unfullfilled / $orders) * 100;
  }

  public function newOrders()
  {
    $new = Order::select('status')->where('status', 0)->count();
    return $new;
  }

  public function customer(Request $request)
  {
    $response = array();
    $request->validate(['customer_id'   => 'required', ]);

    $orders = Order::where('customer_id', $request->customer_id)
              ->orderby('orders.id','desc')
              ->get();

    foreach ($orders as $order) {
      $order->products = $order->products()->select('product_id','price','quantity')->get();
      foreach($order->products as $prod){
        $product        = Product::find($prod['product_id']);
        $prod['title']  = array('en' => $product['title_en'], 'ar' => $product['title_ar']);
        $prod['desc']   = array('en' => $product['desc_en'], 'ar' => $product['desc_ar']);
        // $prod['price']  = $prod['price'];
        // unset($prod['title_en'],$prod['title_ar']);
        // unset($prod['desc_ar'],$prod['desc_en']);

        $prod['images'] = $prod->images->map(function ($data) {
            return $data['link'];
        })->toArray();
      }
      $order->location = $order->location()->select('address','lat','lng')->first();
    }

    if ($orders){
      $response['orders']      = $orders;
      $response['statusCode']  = 200;
    } else{
      $response['statusCode']  = 400;
      $response['msg']         = 'No orders found.';
    }
    return $response;
  }


  public function create(Request $request)
  {
    $response                 = array();
    $order                    = $request->all();
    $request->validate([
      'customer_id'   => 'required',
      'products'      => 'required',
      'total_price'   => 'required',
    ]);
    //
    $products                 = $order['products'];
    $response['out_of_stock'] = array();

    foreach ($products as $product) {
      $prod           = Product::find($product['product_id']);
      if (isset($prod)){
        $country        = $prod->countries()->where('country_id', $order['country_id'])->first();
        if (!isset($country->details) || !isset($country->details->stock) || intval($country->details->stock) < intval($product['quantity'])){
          $response['out_of_stock'][]           = $prod;
        }
      }else{
        $response['out_of_stock'][]           = $product['product_id'];
      }
    }

    if (count($response['out_of_stock']) > 0){
      $response['statusCode']     = 400;
      $response['msg']            = 'Products out of stock';
      return $response;
    }


    $strings                  = ['ZR','DS','MA','WO','XA','RS'];
    $datetime                 = new DateTime();
    $rand_string              = $strings[rand(0,5)];
    $DateHourSec              = $datetime->format('dHs');
    $code_string              = $rand_string.$DateHourSec;
    $order['code']            = $code_string??"N/A";

    $newOrder                 = Order::create($order);

    if ($newOrder){
      if (isset($order['location'])){
        $newOrder->location()->create($order['location']);
      }


      foreach ($products as $product) {
        $prod           = Product::find($product['product_id']);
        $country        = $prod->countries()->where('country_id', $order['country_id'])->first();

        $newOrder->products()->create($product);
        $country->details->stock  -= intval($product['quantity']);
        $country->details->save();
      }

      if ($order['delivery_method'] == 1 && isset($order['location'])){
        $newOrder->location()->create($order['location']);
      }

      // Send order recieved email to customer
      $prods = [];
      foreach ($products as $product) {
        $prod = Product::select('title_en', 'code')->where('id', $product['product_id'])->first();
        $product['name'] = $prod->title_en;
        $product['code'] = $prod->code;
        $prods[] = $product;
      }

      $customer = User::select('name', 'mobile', 'email')->where('id', $order['customer_id'])->first();
      $currency = Country::find($order['country_id']);

      Mail::to($customer->email)->send(new OrderRecieved($newOrder, $prods, $customer, $currency->currency_en));

      $emails         = [ 'no-reply@otantik-home.com',
                          'order.qa@otantik-home.com',
                          'order.bh@otantik-home.com',
                          'order.om@otantik-home.com',
                          'order.kw@otantik-home.com',
                          'order.jo@otantik-home.com',
                          'order.ksa@otantik-home.com',
                        ];
      $countryID      = ($newOrder->country_id) ? $newOrder->country_id : 1;
      Mail::to($emails[$countryID])->send(new OrderRecieved($newOrder, $prods, $customer, $currency->currency_en));

      $response['order_id']     = $newOrder->id;
      $response['statusCode']   = 200;

      // $customer                 = User::select('name', 'mobile', 'cc')->where('id', $order['customer_id'])->first();

      // $cc                       = (isset($customer->cc)) ? $customer->cc : '966';
      // $mobile                   = $cc . $customer->mobile;
      // $message                  = 'Hello '.$customer->name.', we have received your order #'.$newOrder->code.'., You will receive another notification once your order status is updated';
      //
      // $sendSMSResult            = $this->sendSMSunifonic($mobile,$message);

    }else{
      $response['statusCode']     = 400;
      $response['msg']            = 'Ops! Something went wrong..';
    }

    return $response;
  }


  // public function edit(Request $request, $id)
  // {
  //   $order = Order::find($id) ?? 'Order not found!';
  //   //  = Order::find($id)->products->where('order_id', $id);
  //   $products = Order::find($id)->products->where('order_id', $id);
  //
  //   $prods = [];
  //   foreach ($products as $product) {
  //     $prod = Product::select('title_en', 'title_ar')->where('id', $product['product_id'])->first();
  //     $product['name'] = $prod;
  //     $prods[] = $product;
  //   }
  //
  //   $order['products'] = $prods;
  //   $order['customer'] = User::select('name', 'mobile', 'email')->where('id', $order->customer_id)->first();
  //   $order['location'] = Order::find($id)->location()->where('order_id', $id)->get();
  //
  //   return $order;
  // }


  public function edit(Request $request, $id)
  {
    $order                    = Order::find($id) ?? 'Order not found!';
    $user                     = \Auth::Guard('api')->user();

    if (!isset($order)){
      $response['msg']          = 'Order Not found';
      $response['statusCode']   = 400;
      return $response;
    }
    if ($user->rule != 'admin' && $user->rule != 'operator' &&  $user->id != $order->customer_id){
      $response['msg']          = 'You are not authorized to view this';
      $response['statusCode']   = 401;
      return $response;
    }


    $products                 = Order::find($id)->products->where('order_id', $id);
    $prods = [];
    foreach ($products as $product) {
      $prod = Product::select('title_en', 'title_ar')->where('id', $product['product_id'])->first();
      $product['name']  = $prod;
      $product['image'] = $product->mainImage;
      $prods[] = $product;
    }

    $order['products'] = $prods;
    $order['customer'] = User::select('name', 'mobile', 'email')->where('id', $order->customer_id)->first();
    // $order['location'] = Order::find($id)->location()->where('order_id', $id)->get();
    $order['location'] = $order->location;

    return $order;
  }



  public function remove($id)
  {
    $order         = Order::find($id);
    if ($order){
      $order->location()->delete();
      $order->products()->delete();
      $order->delete();
      return 'Delete Successful';
    }else{
      return 'Order not found!';
    }

  }

  public function update(Request $request)
  {
    $info           = $request->all();
    $order           = Order::find($request->order_id);

    if ($order){
      $order->update([
        'delivery_price' => $request->delivery_price,
        'products_price' => $request->products_price,
        'discount' => $request->discount,
        'total_price' => $request->total_price,
        'status' => $request->status,
      ]);

      if ($order->status == 4) {
        $customer = User::select('name', 'mobile', 'email')->where('id', $order->customer_id)->first();
        $currency = Country::find($order['country_id']);
        // $products =


        // Mail::raw('Dear '.$customer->name.', Your order has been delivered to the address provided in invoice #'.$order->code.'. Thank you for choosing Otantik!', function ($message) use ($customer)
        // {
        //   $message->from('otantik@info.com')->to($customer->email)->subject('Order Delivered');
        // });
      }

      $response['order']     = $order;
      $response['statusCode']   = 200;
    }else{
      $response['statusCode']   = 400;
    }

    return $response;
  }



  public function sendSMSunifonic($mobile,$msg){
    $settings                 = array();
    $AppSid                   = 'PWRMeoKYYwIPQUEoINLKQtbJDGteD5';
    $msg                      = preg_replace("/ /", "%20", $msg);

    $ch                       = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://basic.unifonic.com/rest/SMS/messages");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);

    // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $settings ) );
    curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=$AppSid&SenderID=OtantikHome&Recipient=$mobile&Body=$msg");

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "Content-Type: application/x-www-form-urlencoded"
    ));

    $response = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($response, true); // Convert the JSON to an array

    if ( isset($response) && $response['success'] != 'true' ) {
      $errorMsg = $response['message'] ?? "N/A";
      return $errorMsg;
    }elseif (isset($response) && $response['success'] == 'true'){
      return 'success';
    }

  }

}

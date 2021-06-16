<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::post('/import', 'OfferController@import');

// Route::post('/categories/create', 'CategoryController@create');
// Route::delete('/categories/delete/{itemId}', 'CategoryController@remove');
//
//
// Route::post('/categories/filter/create', 'CategoryController@createFilter');
// Route::post('/categories/filter/update', 'CategoryController@updateFilter');
// Route::delete('/categories/{cat}/filter/delete/{id}', 'CategoryController@deleteFilter');
//
// Route::post('/orders/create', 'OrderController@create');
// Route::post('/orders/customer', 'OrderController@customer');
Route::post('/customers/register', 'Mobile\CustomerController@register');
Route::post('/customers/otpCheck', 'Mobile\CustomerController@otpCheck');
Route::post('/customers/otpResend', 'Mobile\CustomerController@otpResend');

Route::get('/customers/appSettings', 'AppPhotoController@mobileAppsSettings');

Route::post('/notifications/updateToken', 'NotificationController@updateToken');


Route::post('/customers/home', 'Mobile\OfferController@home');
Route::get('/customers/categories/list', 'CategoryController@index');

Route::post('/customers/offers/list', 'Mobile\OfferController@list');
Route::post('/customers/offers/view', 'Mobile\OfferController@view');

Route::post('/customers/stores/list', 'Mobile\StoreController@list');
Route::post('/customers/stores/view', 'Mobile\StoreController@view');
Route::post('/customers/store/offers', 'Mobile\StoreController@offers');

Route::post('/customers/account/redeems', 'Mobile\OfferController@myRedeems');

Route::post('/customers/redeem/customer', 'Mobile\RedeemController@CustomerRedeem');
Route::post('/offers/redeems/check', 'Mobile\RedeemController@StoreRedeemCheck');
Route::post('/offers/redeems/use', 'Mobile\RedeemController@StoreRedeem');


Route::get('/statistics/dashboard', 'OfferController@dashboard');
Route::get('/statistics/storeOffers', 'StoreController@storeOffers');
Route::get('/statistics/mostRedeemed', 'OfferController@mostRedeemed');
Route::get('/statistics/offersByCity', 'OfferController@offersByCity');


Route::post('/offers/list', 'OfferController@index');
Route::post('/offers/create', 'OfferController@create');
Route::post('/offers/getInfo', 'OfferController@getInfo');
Route::get('/offers/edit/{id}', 'OfferController@edit');
Route::post('/offers/update', 'OfferController@update');
Route::delete('/offers/delete/{id}', 'OfferController@remove');
Route::post('/offers/addImages', 'OfferController@addImages');
Route::get('/offers/{offer_id}/deleteImage/{image_id}', 'OfferController@deleteImage');


Route::post('/customers/login', 'Mobile\CustomerController@login');

Route::post('/customers/otpCheck', 'Mobile\CustomerController@otpCheck');

Route::post('/customers/list', 'CustomerController@index');
Route::post('/customers/create', 'CustomerController@create');
Route::get('/customers/edit/{id}', 'CustomerController@edit');
Route::post('/customers/update', 'CustomerController@update');
Route::get('/customers/delete/{id}', 'CustomerController@remove');


Route::post('/branches/list', 'StoreController@listBarnches');

Route::middleware('auth:api')->group(function () {

  Route::post('/store/list', 'StoreController@index');
  Route::post('/store/create', 'StoreController@create');
  Route::get('/store/edit/{id}', 'StoreController@edit');
  Route::post('/store/update', 'StoreController@update');
  Route::delete('/store/delete/{id}', 'StoreController@remove');
  Route::post('/store/updateImage', 'StoreController@updateImage');


  Route::post('/app/settings/list', 'AppPhotoController@index');
  Route::post('/app/settings/update', 'AppPhotoController@update');
  Route::delete('/app/settings/deleteImage/{id}', 'AppPhotoController@deleteImage');

  Route::post('/branches/create', 'StoreController@createBranch');
  Route::post('/branches/update', 'StoreController@updateBranch');
  Route::delete('/branches/delete/{id}', 'StoreController@removeBranch');

  Route::post('/users/list', 'UserController@index');
  Route::post('/users/create', 'UserController@create');
  Route::get('/users/edit/{id}', 'UserController@edit');
  Route::post('/users/update', 'UserController@update');
  Route::get('/users/delete/{id}', 'UserController@remove');


  Route::get('/payments/list', 'PaymentController@index');

  Route::post('/notifications/send', 'NotificationController@notify');

});


Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh-token', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('forgotPassword', 'AuthController@forgotPassword');
    Route::post('resetPassword', 'AuthController@resetPassword');
});

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

// Route::get('/categories/list', 'CategoryController@indexPage');
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

Route::post('/customers/home', 'Mobile\OfferController@home');
Route::post('/customers/offers/list', 'Mobile\OfferController@list');
Route::post('/customers/offers/view', 'Mobile\OfferController@view');

Route::post('/customers/stores/list', 'Mobile\StoreController@list');
Route::post('/customers/stores/view', 'Mobile\StoreController@view');


Route::post('/offers/list', 'OfferController@index');
Route::post('/offers/create', 'OfferController@create');
Route::post('/offers/getInfo', 'OfferController@getInfo');
Route::get('/offers/edit/{id}', 'OfferController@edit');
Route::post('/offers/update', 'OfferController@update');
Route::delete('/offers/delete/{id}', 'OfferController@remove');
Route::post('/offers/addImages', 'OfferController@addImages');
Route::get('/offers/{offer_id}/deleteImage/{image_id}', 'OfferController@deleteImage');

Route::post('/store/list', 'StoreController@index');
Route::post('/store/create', 'StoreController@create');
Route::get('/store/edit/{id}', 'StoreController@edit');
Route::post('/store/update', 'StoreController@update');
Route::delete('/store/delete/{id}', 'StoreController@remove');
Route::post('/store/updateImage', 'StoreController@updateImage');

Route::post('/users/list', 'UserController@index');
Route::post('/users/create', 'UserController@create');
Route::get('/users/edit/{id}', 'UserController@edit');
Route::post('/users/update', 'UserController@update');
Route::get('/users/delete/{id}', 'UserController@remove');


Route::post('/customers/login', 'Mobile\CustomerController@login');

Route::post('/customers/otpCheck', 'Mobile\CustomerController@otpCheck');

Route::post('/customers/list', 'CustomerController@index');
Route::post('/customers/create', 'CustomerController@create');
Route::get('/customers/edit/{id}', 'CustomerController@edit');
Route::post('/customers/update', 'CustomerController@update');
Route::get('/customers/delete/{id}', 'CustomerController@remove');

Route::get('/payments/list', 'PaymentController@index');


Route::middleware('auth:api')->group(function () {

});


Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh-token', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

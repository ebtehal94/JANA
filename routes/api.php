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
Route::post('/import', 'ProductController@import');

Route::get('/categories/list', 'CategoryController@indexPage');
Route::post('/categories/create', 'CategoryController@create');
Route::delete('/categories/delete/{itemId}', 'CategoryController@remove');


Route::post('/categories/filter/create', 'CategoryController@createFilter');
Route::post('/categories/filter/update', 'CategoryController@updateFilter');
Route::delete('/categories/{cat}/filter/delete/{id}', 'CategoryController@deleteFilter');

Route::get('/collections/list', 'CollectionController@index');
Route::post('/collections/create', 'CollectionController@create');
Route::post('/collections/update', 'CollectionController@update');
Route::delete('/collections/delete/{id}', 'CollectionController@remove');


Route::post('/orders/create', 'OrderController@create');
Route::post('/orders/customer', 'OrderController@customer');

Route::get('/categories/list', 'CategoryController@indexPage');
Route::post('/categories/create', 'CategoryController@create');
Route::delete('/categories/delete/{itemId}', 'CategoryController@remove');


Route::get('/categories/filter/list', 'CategoryController@listFilters');
Route::get('/categories/{id}/filter/list', 'CategoryController@listCategoryFilters');
Route::get('/filters/show', 'CategoryController@showFilter');
Route::post('/categories/filter/create', 'CategoryController@createFilter');
Route::post('/categories/filter/update', 'CategoryController@updateFilter');

Route::get('/collections/list', 'CollectionController@index');
Route::post('/collections/create', 'CollectionController@create');
Route::post('/collections/update', 'CollectionController@update');


Route::middleware('auth:api')->group(function () {
    Route::post('/products/addImages', 'ProductController@updateImages');
    Route::get('/products/{product}/deleteImage/{id}', 'ProductController@deleteImage');
    Route::post('/products/create', 'ProductController@create');
    Route::post('/products/create-country-product', 'ProductController@createCountryProduct');
    Route::get('/products/edit/{id}', 'ProductController@edit');
    Route::post('/products/update', 'ProductController@update');
    Route::post('/products/countriesSettings/view', 'ProductController@viewCountriesSettings');
    Route::post('/products/countrySettings/update', 'ProductController@updateCountrySettings');
    Route::delete('/products/delete/{id}', 'ProductController@remove');

    Route::get('/categoriesList', 'CategoryController@index');

    Route::get('/users/list', 'UserController@index');
    Route::get('/users/edit/{id}', 'UserController@edit');
    Route::post('/users/update', 'UserController@update');
    Route::get('/users/delete/{id}', 'UserController@remove');

    Route::get('/promocodes/list', 'PromoCodeController@index');
    Route::get('/promocodes/{id}', 'PromoCodeController@show');
    Route::post('/promocodes/create', 'PromoCodeController@create');
    Route::post('/promocodes/update', 'PromoCodeController@update');
    Route::delete('/promocodes/delete/{id}', 'PromoCodeController@remove');



    Route::get('/orders/list', 'OrderController@index');
    Route::get('/orders/sales/count', 'OrderController@countSales');
    Route::get('/orders/sales/new', 'OrderController@newOrders');
    Route::get('/orders/sales/unfullfilled', 'OrderController@unfullfilledOrders');
    Route::get('/orders/edit/{id}', 'OrderController@edit');
    Route::post('/orders/update', 'OrderController@update');
    Route::post('/orders/delete/{id}', 'OrderController@remove');

    Route::post('/pages/edit', 'PagesController@edit');
    Route::get('/pages/deleteImage/{id}', 'PagesController@deleteImage');

});

// Register new users
Route::post('/users/create', 'UserController@create');

Route::post('/pages/view', 'PagesController@view');

Route::get('/pages/offer/list', 'PagesController@getSpecialOffer');
Route::post('/pages/offer/update', 'PagesController@updateSpecialOffer');

Route::post('/pages/addImages', 'PagesController@addImages');
Route::post('/pages/createImage', 'PagesController@createImage');
Route::post('/pages/updateImage', 'PagesController@updateImage');

// Countries CRUD
Route::get('/countries/list', 'CountriesController@index');
Route::get('/countries/list/{id}', 'CountriesController@show');
Route::post('/countries/create', 'CountriesController@store');

Route::get('/products/list', 'ProductController@index');

// Questions CR
Route::get('/questions/list', 'QuestionController@index');
Route::get('/questions/list/{id}', 'QuestionController@show');
Route::post('/questions/create', 'QuestionController@create');
Route::post('/questions/update', 'QuestionController@update');
Route::post('/questions/mail', 'QuestionController@mail');


Route::post('/promoCodes/check', 'PromoCodeController@check');


Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh-token', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

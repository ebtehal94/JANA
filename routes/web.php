<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('search', function() {
    $query = 'كولكش'; // <-- Change the query for testing.

    $articles = App\Models\Product::search($query)->get();

    return $articles;
});

Route::get('/{any}', 'ApplicationController')->where('any', '.*');

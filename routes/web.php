<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function (\App\Services\ProductService $productService) {
    $products  = $productService->all();
    return view('welcome',compact('products'));
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('cart')->name('cart.')->group(function() {
    Route::post('add','CartController@add')->name('add');
    Route::delete('destroy/{id}','CartController@destroy')->name('destroy');
    Route::patch('update-quantity/{id}','CartController@updateQuantity')->name('update.quantity');
});
Route::name('categories.')->prefix('categories')->group(function (){
    Route::get('/','CategoryController@index')->name('index');
    Route::post('store','CategoryController@store')->middleware('auth')->name('store');
    Route::get('show/{id}','CategoryController@show')->name('show');
    Route::put('update/{id}','CategoryController@update')->name('update');
    Route::delete('destroy/{id}','CategoryController@destroy')->name('destroy');
});
Route::name('products.')->prefix('products')->group(function (){
   Route::get("/", "ProductController@index")->name("index");
   Route::get('create', 'ProductController@create')->middleware('auth')->name('create');
   Route::post('store', "ProductController@store")->middleware('auth')->name('store');
   Route::get('show/{id}','ProductController@show')->name('show');
   Route::get("edit/{id}","ProductController@edit")->middleware('auth')->name('edit');
   Route::put('update/{id}','ProductController@update')->middleware('auth')->name('update');
   Route::delete('destroy/{id}','ProductController@destroy')->middleware('auth')->name('destroy');
   Route::get('show-by-category/{categoryId}','ProductsByCategory')->name("by-category");
});
Route::name("orders.")->prefix("orders")->middleware("auth")->group(function (){
    Route::name("index")->get("/",'OrderController@index');
    Route::get("show/{id}",'OrderController@show')->name('show');
    Route::post('store','OrderController@store')->name('store');
    Route::put("update/{id}",'OrderController@update')->name("update");
    Route::delete("destroy/{id}",'OrderController@destroy')->name("destroy");
});

<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'HomepageController');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('cart')->name('cart.')->group(function() {
    Route::view('index','cart.index')->name('index');
    Route::post('add','CartController@add')->name('add');
    Route::delete('destroy/{id}','CartController@destroy')->name('destroy');
    Route::patch('update-quantity/{id}','CartController@updateQuantity')->name('update.quantity');
});
Route::name('categories.')->prefix('categories')->group(function (){
    Route::get('/','CategoryController@index')->middleware(['auth','admin'])->name('index');
    Route::get('create','CategoryController@create')->middleware(['auth','admin'])->name('create');
    Route::post('store','CategoryController@store')->middleware('auth')->name('store');
    Route::get('show/{id}','CategoryController@show')->name('show');
    Route::get('edit/{id}','CategoryController@edit')->middleware(['auth','admin'])->name('edit');
    Route::put('update/{id}','CategoryController@update')->middleware(['auth','admin'])->name('update');
    Route::delete('destroy/{id}','CategoryController@destroy')->middleware(['auth','admin'])->name('destroy');
});
Route::name('products.')->prefix('products')->group(function (){
   Route::get("/", "ProductController@index")->name("index");
   Route::get('create', 'ProductController@create')->middleware(['auth','admin'])->name('create');
   Route::post('store', "ProductController@store")->middleware('auth')->name('store');
   Route::get('show/{id}','ProductController@show')->name('show');
   Route::get("edit/{id}","ProductController@edit")->middleware(['auth','admin'])->name('edit');
   Route::put('update/{id}','ProductController@update')->middleware('auth')->name('update');
   Route::delete('destroy/{id}','ProductController@destroy')->middleware('auth')->name('destroy');
   Route::get('show-by-category/{categoryId}','ProductsByCategory')->name("by-category");

});
Route::name("orders.")->prefix("orders")->middleware("auth")->group(function (){
    Route::name("index")->get("/",'OrderController@index');
    Route::get('edit/{id}','OrderController@edit')->name('edit');
    Route::get("show/{id}",'OrderController@show')->name('show');
    Route::post('store','OrderController@store')->name('store');
    Route::put("update/{id}",'OrderController@update')->name("update");
    Route::delete("destroy/{id}",'OrderController@destroy')->name("destroy");
});
Route::prefix('dashboard')->middleware(['auth','admin'])->name('dashboard.')->group(function(){
    Route::get('main','DashboardStaticsController')->name('index');
    Route::get('products','ProductDashboardIndex')->name('products');
});
Route::prefix('users')->middleware(['auth','admin'])->name('users.')->group(function (){
    Route::get('/','UserController@index')->name('index');
    Route::get('create','UserController@create')->name('create');
    Route::post('store','UserController@store')->name('store');
    Route::get('edit/{id}','UserController@edit')->name('edit');
    Route::put('update/{id}','UserController@update')->name('update');
    Route::delete("destroy/{id}",'UserController@destroy')->name("destroy");

});

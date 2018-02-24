<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your applition. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'bins'], function(){
    Route::get('', 'BinController@index')->name('bins.index');
    Route::get('create', 'BinController@create')->name('bins.create');
    Route::post('store', 'BinController@store')->name('bins.store');
    Route::get('{bin}', 'BinController@show')->name('bins.show');
    Route::get('{bin}/edit', 'BinController@edit')->name('bins.edit');
    Route::put('{bin}', 'BinController@update')->name('bins.update');
    Route::get('{bin}/delete', 'BinController@destroy')->name('bins.destroy');
    Route::any('{uid}/listen', 'BinController@listen')->name('bins.listen');
});
Route::group(['prefix' => 'requests'], function(){
  Route::get('{request}/delete', 'RequestController@destroy')->name('requests.destroy');
});

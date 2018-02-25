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
    Route::get('', 'BinController@index')->middleware('auth')->name('bins.index');
    Route::get('create', 'BinController@create')->middleware('auth')->name('bins.create');
    Route::post('store', 'BinController@store')->middleware('auth')->name('bins.store');
    Route::get('{bin}', 'BinController@show')->middleware('auth', 'binbelongstouser')->name('bins.show');
    Route::get('{bin}/edit', 'BinController@edit')->middleware('auth', 'binbelongstouser')->name('bins.edit');
    Route::put('{bin}', 'BinController@update')->middleware('auth', 'binbelongstouser')->name('bins.update');
    Route::get('{bin}/delete', 'BinController@destroy')->middleware('auth', 'binbelongstouser')->name('bins.destroy');
});
Route::group(['prefix' => 'requests'], function(){
  Route::get('{request}/delete', 'RequestController@destroy')->name('requests.destroy');
  Route::any('{request}/endpoint', 'RequestController@endpoint')->name('requests.endpoint');
});

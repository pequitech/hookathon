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


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group(['prefix' => 'bins'], function ($router) {
    Route::any('/{uid}/listen', 'BinController@apiSaveRequests')->name('bins.listen');

    Route::group(['middleware' => 'api'], function ($router) {
        Route::get('', 'BinController@apiGetBins');
        Route::post('', 'BinController@apiStoreBin');
        Route::get('{uid}', 'BinController@apiShowBin');
        Route::put('{uid}', 'BinController@apiEditBin');
        Route::delete('{uid}', 'BinController@apiDestroyBin');
        Route::get('{uid}/requests', 'BinController@apiGetRequests');
    });
});

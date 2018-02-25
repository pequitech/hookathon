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


Route::get('/bins/{uid}/requests', function(Request $request, $uid){
    $bin = \App\Bin::first();
    return $bin->requests;
});

Route::any('/bins/{uid}/listen', function(Request $request, $uid){
    $bin = \App\Bin::where('uid', $uid)->first();
    if(!$bin){
        return response('Bin not found, create a bin to receive your requests on https://hookathon.co', 404);
    }

    try {
        //Esse código precisa de tratamento pois pode gerar alguma exceção
        $newRequest = \App\Request::create([
            'uid' => \Carbon\Carbon::now()->format('U'),
            'bin_id' => $bin->id,
            'header' => json_encode($request->headers->all()),
            'body'  => json_encode($request->all())
        ]);
    } catch (\Exception $e) {
        return response('Fail!', 500)
            ->header('Content-Type', 'text/plain');
    }
    return response('OK!', 200)
        ->header('Content-Type', 'text/plain');

})->name('bins.listen');

<?php

namespace App\Http\Controllers;

use App\Bin;
use Illuminate\Http\Request;

class BinController extends Controller
{
    protected $rules = [
        'name' => 'string|min:5|max:100'
    ];

    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bins = Bin::loggedUser($request->user())->paginate(50);
        return view('bins.index')->with(compact('bins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $bin = new Bin();
        return view("bins.create")->with(compact('bin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $bin = Bin::create([
          "name" => $request->name,
          "user_id" => $request->user()->id,
          "uid" => \Carbon\Carbon::now()->format('U') . rand()
        ]);

        return redirect()->route('bins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bin  $bin
     * @return \Illuminate\Http\Response
     */
    public function show(Bin $bin, Request $request)
    {
        //
        return view("bins.show")->with(compact('bin'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bin  $bin
     * @return \Illuminate\Http\Response
     */
    public function edit(Bin $bin, Request $request)
    {
      return view("bins.edit")->with(compact('bin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bin  $bin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bin $bin)
    {
        $this->validate($request, $this->rules);

        $bin->update($request->all());

        return redirect()->route('bins.show', ['bin' => $bin]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bin  $bin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bin $bin)
    {
        //
        $bin->delete();
        return redirect()->route('bins.index');
    }

    public function apiSaveRequests(Request $request, $uid){
        $bin = \App\Bin::uid($uid)->first();

        if(!$bin){
            return response('Bin not found, create a bin to receive your requests', 404);
        }

        try {
            $newRequest = \App\Request::create([
                'uid' => \Carbon\Carbon::now()->format('U'),
                'bin_id' => $bin->id,
                'header' => [
                    'method' => $request->server->get('REQUEST_METHOD'),
                    'content_type' => $request->headers->get('content_type')
                ],
                'body'  => json_encode($request->all())
            ]);
        } catch (\Exception $e) {
            return response('Fail!', 500)
                ->header('Content-Type', 'text/plain');
        }
        return response('OK!', 200)
            ->header('Content-Type', 'text/plain');

    }

    public function apiGetRequests(Request $request, $uid){
        $user = \JWTAuth::parseToken()->authenticate();
        $bin = \App\Bin::uid($uid)->first();

        if($bin){
            return $bin->requests;
        }

        return response()->json([
            'error' => 'Sorry, no bins found for this uid on your account.'
        ], 404);
    }

    public function apiStoreBin(Request $request)
    {
        $this->validate($request, $this->rules);

        $user =  \JWTAuth::parseToken()->authenticate();

        $bin = Bin::create([
          "name" => $request->name,
          "user_id" => $user->id,
          "uid" => \Carbon\Carbon::now()->format('U') . rand()
        ]);

        return $bin;
    }

    public function apiShowBin(Request $request, $uid)
    {
        $user =  \JWTAuth::parseToken()->authenticate();
        $bin = \App\Bin::uid($uid)->loggedUser($user)->first();
        if($bin){
            return $bin;
        }
        return response()->json([
            'error' => 'Sorry, no bins found for this uid on your account.'
        ], 404);
    }

    public function apiGetBins(Request $request)
    {
        $user =  \JWTAuth::parseToken()->authenticate();
        $bins = \App\Bin::loggedUser($user)->get();

        return $bins ?? [];
    }

    public function apiEditBin(Request $request, $uid)
    {
        $this->validate($request, $this->rules);

        $user =  \JWTAuth::parseToken()->authenticate();
        $bin = Bin::uid($uid)->loggedUser($user)->first();

        if(!$bin){
            return response()->json([
                'error' => 'Sorry, no bins found for this uid on your account.'
            ], 404);
        }

        $bin->update([
          "name" => $request->name,
        ]);

        return response()->json([
            'message' => 'Bin updated with success.'
        ],200);
    }

    public function apiDestroyBin(Request $request, $uid)
    {
        $this->validate($request, $this->rules);

        $user =  \JWTAuth::parseToken()->authenticate();
        $bin = Bin::uid($uid)->loggedUser($user)->first();

        if(!$bin){
            return response()->json([
                'error' => 'Sorry, no bins found for this uid on your account.'
            ], 404);
        }

        $bin->delete();

        return response()->json([
            'message' => 'Bin deleted with success.'
        ],200);
    }
}

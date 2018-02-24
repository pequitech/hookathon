<?php

namespace App\Http\Controllers;

use App\Bin;
use Illuminate\Http\Request;

class BinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bins = Bin::paginate(50);
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
        //
        $bin = Bin::create([
          "name" => $request->name,
          "email" => $request->email,
          "password" => $request->password,
          "uid"=> md5(rand() . \Carbon\Carbon::now()),
          "user_id"=> $request->user()->id
        ]);

        return redirect()->route('bins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bin  $bin
     * @return \Illuminate\Http\Response
     */
    public function show(Bin $bin)
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
    public function edit(Bin $bin)
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
        //
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
}

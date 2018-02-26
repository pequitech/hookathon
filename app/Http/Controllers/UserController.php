<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = new \App\User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        $user->save();

        return response()->json([
            'message' => 'sucessfuly created user.',
        ], 201);
    }

    public function signin(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json([
                    'error' => 'Invalid credentials',
                ], 401);
            }
        } catch(JWTException $e){
            return response()->json([
                'error' => 'Could not create token'
            ],500);
        }

        return response()->json([
            'token' => $token
        ], 200);
    }
}

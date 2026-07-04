<?php

namespace App\Http\Controllers;

use App\Models\auth;
use App\Models\Auth as ModelsAuth;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function store(Request $request)
    {
       try {
         //check if exsits user
        $existsUser=ModelsAuth::where('email','=',$request->email,'and')->first();
        if($existsUser){
            return response()->json(['message'=>'User already exists'],400);
        }
        $user=ModelsAuth::create([
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>$request->password
        ]);
        return response()->json(['message'=>'User created successfully','user'=>$user],201);
       } catch (\Throwable $th) {
        return response()->json(['message'=>'Something went wrong','error'=>$th->getMessage()],500);
       }
    }


    public function show(Request $request)
    {
       $user=ModelsAuth::where('email','=',$request->email,'and')->first();
       if(!$user){
        return response()->json([
            'message'=>'User not found'
        ],404);}

        if($user->password !== $request->password){
            return response()->json([
                'message'=>'Invalid password'
            ],401);
        }
        return response()->json([
            'message'=>'User logged in successfully',
            'user'=>$user
        ],200);
    }


}

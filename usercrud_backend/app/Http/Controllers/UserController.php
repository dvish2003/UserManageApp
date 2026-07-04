<?php

namespace App\Http\Controllers;

use App\Models\user;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=ModelsUser::all();
        return response()->json($users,200);
    }


    public function store(Request $request)
    {
        //
       try {
         $exsitingUser = ModelsUser::where('email', $request->email)->first();
        if($exsitingUser) {
            return response()->json(['message' => 'User already exists'], 409);
        }
        $user = ModelsUser::create([
            'username' => $request->username,
            'email' => $request->email,
            'age' => $request->age
        ]);
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
       } catch (\Throwable $th) {
        return response()->json(['message' => 'Failed to create user', 'error' => $th->getMessage()], 500);
       }
    }


    public function show($email)
    {
        $user = ModelsUser::where('email', $email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user, 200);
    }



 public function update(Request $request)
{
    try {

        $user = ModelsUser::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'age' => $request->age
        ]);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ], 200);

    } catch (\Throwable $th) {

        return response()->json([
            'message' => 'Failed to update user',
            'error' => $th->getMessage()
        ], 500);

    }
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($email)
    {
        $user = ModelsUser::where('email', $email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
        
}

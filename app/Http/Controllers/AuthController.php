<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;
use App\Models\User;

class AuthController extends Controller
{
    // membuat login token dengan sanctum
    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;

        $credential = [
            'email' => $username,
            'password' => $password
        ];
        if(Auth::attempt($credential)){
            $user = Auth::user();
            $ability = ['create', 'read', 'update', 'delete'];

            return response()->json([
                'status' => true,
                'user' => $user,
                'token' => $user->createToken('api-token', $ability)->plainTextToken,
                'ability' => $ability,
                'message' => 'Login Success'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Login Failed'
            ]);
        }
    }
}

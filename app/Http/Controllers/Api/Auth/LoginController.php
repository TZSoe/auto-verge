<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            "username" => "required|string",
            "password" => "required|string",
        ]);
        
        $user = User::where('username', $request->username)->first();

        if(!$user || !Hash::check($request->password, $user->password))
        {
            return response()->json([
                "status" => "error",
                "message"  => "Invalid Credentials",
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user->tokens()->delete();

        return response()->json([
            "status" => "success",
            "access_token" => $user->createToken('auto-verge-employee')->plainTextToken
        ]);
    }
}

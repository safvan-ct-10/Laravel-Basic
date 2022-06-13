<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if($user) {
            if(Hash::check($request->password, $user->password)) {
                $token = $user->createToken($request->device)->plainTextToken;
                return response()->json([
                    'response' => 'success',
                    'message' => 'Login successfully',
                    'token' => $token
                ]);
            }
            else {
                return response()->json([
                    'response' => 'error',
                    'message' => 'Inavlid password'
                ]);
            }
        }
        else {
            return response()->json([
                'response' => 'error',
                'message' => 'Inavlid email address'
            ]);
        }
    }

    public function getUser()
    {
        $user_id = auth()->user()->id;
        $user = User::with('country')->find($user_id)->makeHidden(['active_text', 'human_days']);
        if($user) {
            return response()->json([
                'response' => 'success',
                'user' => $user
            ]);
        }
        else {
            return response()->json([
                'response' => 'error',
                'message' => 'Inavlid User'
            ]);
        }
    }

    public function logout()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $user->tokens()->delete();

        return response()->json([
            'response' => 'success',
            'message' => 'Loggedout successfully'
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class AuthController extends Controller
{
    public function __construct(private User $user){}

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $user = $this->user
        ->where('email', $request->email)
        ->first();
        if(empty($user)){
            return response()->json([
                'errors' => 'email is wrong'
            ], 400);
        }
        if (password_verify($request->input('password'), $user->password)){
            $user->token = $user->createToken('admin')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $user->token,
                'role' => 'admin',
            ]);
        }
        
        return response()->json(['faield'=>'creational not Valid'],403);
    }
}

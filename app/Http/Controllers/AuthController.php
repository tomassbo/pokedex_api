<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response([
                'res' => false,
                'message' =>  $validator->errors(),
            ], 401);
        }

        $user = User::whereEmail($request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            $token = $user->createToken('authToken')->accessToken;

            return response([
                'res' => true,
                'token' => $token,
                'user' => $user,
            ], 200);
        } else {

            return response([
                'res' => false,
                'message' => 'Incorrect e-mail or password',
            ], 401);
        }
    }
}

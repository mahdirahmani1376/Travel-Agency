<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if (! auth()->attempt($request->only(['password','email']))){
            return Response::json(
              data: [
                  'message' => 'the provided email or password is incorrect'
                ],
              status: 401
            );
        }

        $user = User::where('email', $data['email'])->first();

        return Response::json(
          data: [
              'message' => 'user logged in successfully',
              'token' => $user->createToken("access_token")->plainTextToken
            ]
        );

    }

}

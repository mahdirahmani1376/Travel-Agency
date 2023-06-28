<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use OpenApi\Annotations as OA;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/login",operationId="LoginUser",tags={"Users"},description="login the user",
     *      @OA\RequestBody(required=true,@OA\JsonContent(ref="#/components/schemas/LoginData"),),
     *      @OA\Response(response=200,description="Successful operation",),
     *      @OA\Response(response=401,description="Unauthenticated",),
     *      @OA\Response(response=403,description="unauthorized"),
     * ),
     */
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

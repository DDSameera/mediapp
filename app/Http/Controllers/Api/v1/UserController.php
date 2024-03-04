<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\UserRequest;
use App\Http\Resources\Api\v1\UserResource;
use App\Models\Api\v1\User;
use App\Services\Api\v1\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{

    public function register(UserRequest $request)
    {
        $user =   User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);

        $token = $user->createToken($request->username)->plainTextToken;

        $userData = (object)[
            'username' => $user->username,
            'token' => $token
        ];


        return  ResponseService::successResponse('User Registered Successfully', new UserResource($userData));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            $userData = (object)[
                'username' => $user->username,
                'token' => $token
            ];

            return  ResponseService::successResponse('User Authenticated Successfully', new UserResource($userData));
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout()
    {

        if (Auth::user()->tokens()->delete()) {
            return  ResponseService::successResponse('User Logged out Successfully');
        }
    }
}

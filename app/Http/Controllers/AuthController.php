<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param SignUpRequest $request
     * @return JsonResponse
     */
    public function signup(SignUpRequest $request)
    {
        User::query()->truncate(); // Remove this line for to keep other data

        $requestUser = $request->get('user');
        $userData = $requestUser;
        $userData['password'] = bcrypt($requestUser['encrypted_password']);
        unset($userData['encrypted_password']);

        $user = User::create($userData);
        $token = $user->createToken('api_token')->plainTextToken;
        $response = [
            'email' => $userData['email'],
            'token' => encrypt($token),
            'username' => $userData['username'],
        ];

        return response()->json($response, 201);
    }

    public function signin(Request $request)
    {
        $authenticate = Auth::attempt($request->all());
        if (!$authenticate) {
            return response()->json([
                'message' => 'Oops! Your credentials is invalid!'
            ], 401);
        }

        $token = auth()->user()->createToken('api_token')->plainTextToken;
        return \response()->json([
            'email' => $request->get('email'),
            'token' => encrypt($token),
            'username' => auth()->user()->getUsername()
        ]);
    }
}

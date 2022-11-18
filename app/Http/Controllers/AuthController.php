<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use PHPUnit\Exception;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;

class AuthController extends Controller
{
    /*******************************************
     * set middleware for exception auth methods
     ******************************************/
    public function __construct()
    {
    }

    /*********************************************
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     * set authentication for jwt login
     * you must assign two parameters for login
     * email address and password
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Invalid login details'
            ], HTTPResponse::HTTP_UNAUTHORIZED);
        $user = Auth::user();
        return response()->json([
            'status' => true,
            'token' => $user->createToken("auth_token")->plainTextToken
        ], HTTPResponse::HTTP_OK);


    }

    /********************************************************
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse|void
     * it's a method for register user and create new account.
     *********************************************************/
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
//            dd($user->createToken("auth_token"));
            $credentials = $request->only('email', 'password');
            if (!Auth::attempt($credentials))
                return response()->json([
                    'message' => 'Invalid register details'
                ], HTTPResponse::HTTP_UNAUTHORIZED);


            return response()->json([
                'message' => 'your user created successfully',
                'status' => true,
                'token' => $user->createToken("auth_token")->plainTextToken
            ], HTTPResponse::HTTP_OK);

        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], $exception->getCode());
        }

    }

    /***************************************
     * @return \Illuminate\Http\JsonResponse
     * sing out user method
     ***************************************/
    public function logout()
    {
        $user=Auth::user();
        $user->tokens()->delete();
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }


}

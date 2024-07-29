<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware("auth:api", ["except"=> ["login"]]);
    // }

    public function register(Request $request)
{
    $this->validate($request, [
        "name" => "required",
        "email" => "required|unique:users,email",
        "password" => "required|min:6",
        "role" => "required"
    ]);

    $user = new User;

    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->role = $request->role;
    $user->save();

    return response()->json(["message" => "user created successfully!", "code" => "201"]);
}


    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}

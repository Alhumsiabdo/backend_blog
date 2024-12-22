<?php

namespace App\Repository\Dashboard\Eloquent;

use App\Models\User;
use App\Repository\Dashboard\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $userData)
    {
        $name = $userData['name'];
        $email = $userData['email'];
        $role = $userData['role'];
        $password = $userData['password'];

        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->role = $role;
        $user->password = $password;
        $user->save();

        return true;
    }

    public function login(array $credentials)
    {
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return response()->json(['error' => 'Email not found'], 404);
        }

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid password'], 401);
        }

        $token = Auth::attempt($credentials);
        $user = Auth::user();

        return $this->respondWithToken($token, $user);
    }


    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out', 'code' => 200]);
    }

    protected function respondWithToken($token, ?Authenticatable $user)
    {
        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'code' => 200,
        ]);
    }
}

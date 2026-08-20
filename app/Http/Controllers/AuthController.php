<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = auth('api')->login($user);

        return response()->json([
            'user' => $user,
            'token' => $token,
            'token_type' => 'bearer',
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json([
                'message' => 'Credenciales incorrectas',
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json([
            'user' => auth('api')->user(),
        ]);
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json([
            'message' => 'Sesión cerrada correctamente',
        ]);
    }

    public function refresh()
    {
        return $this->respondWithToken(
            auth('api')->refresh()
        );
    }

    protected function respondWithToken(string $token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }
}
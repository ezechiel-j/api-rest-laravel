<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller

{
    public function register(Request $request)
    {
        try {
            //définition des règles de validation
            $validateUser = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]);

            //gestion de l'erreur de validation
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            //si validation ok création du user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            //réponse renvoyée au front
            return response()->json([
                'status' => true,
                'message' => 'user created',
                'toker' => $user->createToken("API TOKEN")->plainTextToken
                //création du token dans la table personnal_access_tokens
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);

        $validateUser = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        //on recherche le premier utilisateur par rapport à l'email
        $user = User::where('email', $request->email)->first();

        //on teste le mot de passe par rapport à celui de l'utilisateur
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => false,
                'message' => 'invalid credentials',
            ], 401);
        }

        //création d'un token
        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'user logged in',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function me(Request $request)
    {
        $userData = auth()->user();

        return response()->json([
            'status' => true,
            'message' => 'profile information',
            'data' => $userData,
            'id' => auth()->user()->id
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'user logged out',
        ], 200);
    }
}

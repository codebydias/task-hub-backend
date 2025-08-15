<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;


class AuthService
{

    public function register(array $data)
    {

        if (Usuario::where('email', $data['email'])->exists()) {
            return response()->json('Email já cadastrado', 409);
        }


        $user = Usuario::create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'senha' => Hash::make($data['senha']),
        ]);

        return response()->json([
            'mensagem' => "Usuario com o {$user->email} criado com sucesso",
        ], 201);
    }

    public function login(array $data)
    {

        $user = Usuario::where('email', $data['email'])->first();

        if (! $user) {
            return response()->json(['error' => 'Email ou senha inválidos'], 401);
        }

        if (! Hash::check($data['senha'], $user->senha)) {
            return response()->json(['error' => 'Email ou senha inválidos'], 401);
        }

        $token = app('tymon.jwt.auth')->fromUser($user);

        return response()->json([
            'token' => $token,
            'mensagem' => "Usuário com o email {$user->email} logado com sucesso",
        ], 200);
    }
}

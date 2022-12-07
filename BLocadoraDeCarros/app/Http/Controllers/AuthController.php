<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $crendenciais = $request->all(['email','password']);

        //autenticar o usuario
        $token = auth('api')->attempt($crendenciais);

        // retornar um JWT (token)
        if($token){
            return response()->json(['token' => $token], 200);
        }else{
            // 401 = Unauthorized -> não autorizado
            // 403 = forbidden ->proibido (login invalido)
            return response()->json(['error' => 'Usuário ou senha inválido!'], 403);
        }
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['msg' => 'Logout realizado com sucesso']);
    }

    public function refresh()
    {
        $token = auth('api')->refresh();
        return response()->json(['token' => $token]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
}

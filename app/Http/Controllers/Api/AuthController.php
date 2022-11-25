<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Resources\UserResource;



class AuthController extends Controller
{
    public function createUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'USUARIO_NOME'  =>   'required',
                'USUARIO_EMAIL' =>   'required',
                'USUARIO_CPF'   =>   'required',    
                'USUARIO_SENHA' =>   'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status'   => false,
                    'message'  => 'Erro ao cadastrar usuário - Campos obrigatórios não preenchidos',
                    'errors'   => $validateUser->errors()
                ], 401);
            }

            $USUARIO = User::create([
                'USUARIO_NOME'  =>   $request->USUARIO_NOME,
                'USUARIO_EMAIL' =>   $request->USUARIO_EMAIL,
                'USUARIO_CPF'   =>   $request-> USUARIO_CPF,
                'USUARIO_SENHA' =>   Hash::make($request->USUARIO_SENHA)
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Usuario cadastrado com sucesso',
                
                //'token'   => $USUARIO->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function loginUser(){
        try {
            $credentials = request(['USUARIO_EMAIL', 'USUARIO_SENHA']);
            $user = User::where('USUARIO_EMAIL', $credentials['USUARIO_EMAIL'])->first();
            if (!$user || !Hash::check($credentials['USUARIO_SENHA'], $user->USUARIO_SENHA)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Usuário ou senha incorretos',
                    
                ], 401);
            }

            return response()->json([
                'status' => true,
                'message' => 'Login realizado com sucesso',
                'data' => UserResource::collection($user), 
              //  'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


   

}


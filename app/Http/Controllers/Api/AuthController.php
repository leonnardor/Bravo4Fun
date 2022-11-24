<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;



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

    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [         
                'USUARIO_EMAIL' => 'required|email',
                'USUARIO_SENHA' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Erro ao logar usuário - Campos obrigatórios não preenchidos',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['USUARIO_EMAIL', 'USUARIO_SENHA']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email ou senha incorretos ou não existem',
                    
                ], 401);
            }

            $user = Usuario::where('USUARIO_EMAIL', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'Usuario logado com sucesso',
             
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logoutUser(Request $request)
    {
        try {
            $request->user()->tokens()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Usuário deslogado com sucesso',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getUser(Request $request)
    {
        try {
            $user = $request->user();

            return response()->json([
                'status' => true,
                'message' => 'Detalhes do Usuário: ',
                'data' => $user
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


}


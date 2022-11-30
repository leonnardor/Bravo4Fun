<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
class UserController extends Controller
{

   // get user by id authenticated in login route 

   public function show($id)
   {
       $user = User::where('USUARIO_ID', $id)->get();
       return response()->json([
           'status' => 200,
           'message' => 'Usuário listado com sucesso',
           'data' => UserResource::collection($user)
       ], 200);
   }

   
   
}

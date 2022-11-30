<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Products;
use App\Models\Images;
use App\Http\Resources\CartResource;



class CartController extends Controller
{

    public function index()
    {
        try {
            $cart = Cart::all();
            return response()->json($cart, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
       try {
            $cart = Cart::where('USUARIO_ID', $id)->get();
            $total = 0;
            foreach ($cart as $item) {
                $total += $item->PRODUTO_PRECO;
            }
            return response()->json([
                'status' => 200,
                'message' => 'Carrinho listado com sucesso',
                'data' => CartResource::collection($cart),
                'Total do Pedido' => $total
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro ao listar carrinho',
                'data' => $e->getMessage()
            ], 500);
        }
    }


    public function store(Request $request)
    {
        try {
            $cart = Cart::create($request->all());
            return response()->json([
                'status' => 200,
                'message' => 'Carrinho criado com sucesso',
                'data' => $cart
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro ao criar carrinho',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    


}

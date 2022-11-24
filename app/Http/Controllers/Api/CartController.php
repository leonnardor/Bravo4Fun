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
            return response()->json([
                'status' => 200,
                'message' => 'Carrinho listado com sucesso',
                'data' => CartResource::collection($cart)
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
                'message' => 'Produto adicionado ao carrinho com sucesso',
                'data' => CartResource::collection($cart)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro ao adicionar produto ao carrinho',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
       try {
            $cart = Cart::where('USUARIO_ID', auth()->user()->USUARIO_ID)->where('PRODUTO_ID', $id)->update($request->all());
            return response()->json([
                'status' => 200,
                'message' => 'Produto atualizado com sucesso',
                'data' => CartResource::collection($cart)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro ao atualizar produto',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
       try {
            $cart = Cart::where('USUARIO_ID', auth()->user()->USUARIO_ID)->where('PRODUTO_ID', $id)->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Produto removido com sucesso',
                'data' => CartResource::collection($cart)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro ao remover produto',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function clearCart()
    {
        try {
            $cart = Cart::where('USUARIO_ID', auth()->user()->USUARIO_ID)->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Carrinho limpo com sucesso',
                'data' => CartResource::collection($cart)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro ao limpar carrinho',
                'data' => $th
            ], 500);
        }
    }

    public function checkout()
    {
       try {
            $cart = Cart::where('USUARIO_ID', auth()->user()->USUARIO_ID)->get();
            $cart->each(function($item) {
                $item->ITEM_STATUS = 1;
                $item->save();
            });
            return response()->json([
                'status' => 200,
                'message' => 'Compra realizada com sucesso',
                'data' => CartResource::collection($cart)
            ], 200);
         } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro ao realizar compra',
                'data' => $th
            ], 500);
    }
}
}

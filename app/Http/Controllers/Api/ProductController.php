<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Products::all();
         return response()->json([
              'status' => 200,
              'message' => 'Produtos listados com sucesso',
              'data' => ProductResource::collection($products)
         ], 200);
    }

    public function create()
    {
        $products = Products::create($request->all());
        return response()->json([
            'status' => 200,
            'message' => 'Produto cadastrado com sucesso',
            'data' => ProductResource::collection($products)
        ], 200);
    }

    public function store(Request $request)
    {
        $products = Products::create($request->all());
        return response()->json([
            'status' => 200,
            'message' => 'Produto cadastrado com sucesso',
            'data' => ProductResource::collection($products)
        ], 200);
    }

   public function show($id)
    {
        $products = Products::where('PRODUTO_ID', $id)->get();
        return response()->json([
            'status' => 200,
            'message' => 'Produto listado com sucesso',
            'data' => ProductResource::collection($products)
        ], 200);
    }


    public function getProductsByCategory($id)
    {
        $products = Products::where('CATEGORIA_ID', $id)->get();
        return response()->json([
            'status' => 200,
            'message' => 'Produtos listados com sucesso',
            'data' => ProductResource::collection($products)
        ], 200);
    }

    public function searchProducts($search)
    {
        $products = Products::where('PRODUTO_NOME', 'like', '%'.$search.'%')->get();


        if (count($products) > 0) {
            return response()->json([
                'status' => 200,
                'message' => 'Resultados para a busca '.$search,
                'data' => ProductResource::collection($products)
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Nenhum produto encontrado com o termo '.$search,
            ], 404);
        }


  
    }


}
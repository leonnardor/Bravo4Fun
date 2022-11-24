<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;






class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
         return response()->json([
              'status' => 200,
              'message' => 'Categorias listadas com sucesso',
              'data' => CategoryResource::collection($categories)
         ], 200);
    }

   
    public function create()
    {
        
    }

  
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
       
    }

   
    public function edit(Products $products)
    {
        
    }

    
    public function update(Request $request, Products $products)
    {
        
    }

    
    public function destroy(Products $products)
    {
        
    }

   
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;



class ProductResource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
            'id' => $this->PRODUTO_ID,
            'name' => $this->PRODUTO_NOME,
            'description' => $this->PRODUTO_DESC,
            'price' => $this->PRODUTO_PRECO,
            'imagem' => $this->images ? $this->images->map(function($image){ 
                return $image->IMAGEM_URL;
            }) : null,
            'image_order' => $this->images ? $this->images->map(function($image){
                return $image->IMAGEM_ORDEM;
            }) : null,
            'category' => $this->category->CATEGORIA_NOME,
            'discount' => $this->PRODUTO_DESCONTO,
            'active' => $this->PRODUTO_ATIVO,
        ];

        return parent::toArray($request);
    }
}

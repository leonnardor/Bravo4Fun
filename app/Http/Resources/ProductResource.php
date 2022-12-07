<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;



class ProductResource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
            'PRODUTO_ID' => $this->PRODUTO_ID,
            'PRODUTO_NOME' => $this->PRODUTO_NOME,
            'PRODUTO_DESC' => $this->PRODUTO_DESC,
            'PRODUTO_PRECO' => $this->PRODUTO_PRECO,
            'PRODUTO_IMAGEM' => $this->images->first()->PRODUTO_IMAGEM,
            'category' => $this->category->CATEGORIA_NOME,
            'discount' => $this->PRODUTO_DESCONTO,
            'active' => $this->PRODUTO_ATIVO,
        ];

        return parent::toArray($request);
    }
}

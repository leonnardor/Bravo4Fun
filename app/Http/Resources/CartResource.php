<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       
        return [
            'PRODUTO_ID' => $this->PRODUTO_ID,
            'ITEM_QTD' => $this->ITEM_QTD,
            'PRODUTO_NOME' => $this->products->PRODUTO_NOME,
            'PRODUTO_PRECO' => $this->products->PRODUTO_PRECO,
            'PRODUTO_PRECO_TOTAL' => $this->products->PRODUTO_PRECO * $this->ITEM_QTD,
            'PRODUTO_IMAGEM' => $this->products->images->first()->PRODUTO_IMAGEM,
        ];
        return parent::toArray($request);
    }
}

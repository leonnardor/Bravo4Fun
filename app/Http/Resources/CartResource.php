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
            'PRODUTO_NOME' => $this->PRODUTO_NOME,
            'ITEM_QTD' => $this->ITEM_QTD,
            'PRODUTO_NOME' => $this->products->PRODUTO_NOME,
        ];
        return parent::toArray($request);
    }
}

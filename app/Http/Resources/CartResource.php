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
        return parent::toArray($request);

        return [
            'id' => $this->PRODUTO_ID,
            'name' => $this->PRODUTO_NOME,
            'quantity' => $this->ITEM_QTD,
            'nome' => $this->products->PRODUTO_NOME,
        ];
    }
}
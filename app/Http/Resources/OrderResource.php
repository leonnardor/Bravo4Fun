<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'PEDIDO_ID' => $this->PEDIDO_ID,
            'PEDIDO_DATA' => date('d/m/Y', strtotime($this->PEDIDO_DATA)),
            'STATUS_PEDIDO' => $this->STATUS_ID == 2 ? 'Pagamento não efetuado' : 'Pagamento Efetuado',
        ];

        return parent::toArray($request);
    }
}

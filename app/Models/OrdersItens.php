<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersItens extends Model
{
    use HasFactory;

    protected $fillable = [
        'PEDIDO_ID',
        'PRODUTO_ID',
        'ITEM_QTD',
        'ITEM_PRECO',
    ];

    protected $primaryKey = 'PEDIDO_ID';
    protected $foreignKey = 'PRODUTO_ID';
    protected $table = 'PEDIDO_ITEM';


    public $timestamps = false;

    public function orders()
    {
        return $this->belongsTo(Orders::class, 'PEDIDO_ID');
    }

    public function products()
    {
        return $this->belongsTo(Products::class, 'PRODUTO_ID');
    }

    public function itemPrice()
    {
        return $this->products->PRODUTO_PRECO;
    }

    
}

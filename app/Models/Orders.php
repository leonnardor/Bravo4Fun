<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Images;
use App\Models\OrdersItens;
use App\Models\Orders;
use App\Models\OrdersStatus;




class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'PEDIDO_ID',
        'USUARIO_ID',
        'STATUS_ID',
        'PEDIDO_DATA',
        'STATUS_DESC',
    ];

    protected $primaryKey = 'PEDIDO_ID';
    protected $foreignKey = 'USUARIO_ID';
    protected $table = 'PEDIDO';


    public $timestamps = false;

   
    public function ordersItens()
    {
        return $this->hasMany(OrdersItens::class, 'PEDIDO_ID'); 
    }

    // 
  

    
}
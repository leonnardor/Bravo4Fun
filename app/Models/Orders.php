<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Images;



class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'PEDIDO_ID',
        'USUARIO_ID',
        'STATUS_ID',
        'PEDIDO_DATA',
    ];

    protected $primaryKey = 'PEDIDO_ID';
    protected $foreignKey = 'USUARIO_ID';
    protected $table = 'PEDIDO';


    public $timestamps = false;

    
}
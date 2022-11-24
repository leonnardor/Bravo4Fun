<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
use App\Models\Images;


class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
         'USUARIO_ID',
         'PRODUTO_ID',
         'ITEM_QTD',
        
         
    ];

    protected $primaryKey = 'usuario_id';
    protected $foreignKey = 'produto_id';
    protected $table = 'CARRINHO_ITEM';


    public $timestamps = false;

    public function products()
    {
        return $this->belongsTo(Products::class, 'PRODUTO_ID');
    }

    public function images()
    {
        return $this->hasMany(Images::class, 'PRODUTO_ID');
    }


}

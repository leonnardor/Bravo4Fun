<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Images;


class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'PRODUTO_ID',
        'PRODUTO_NOME',
        'PRODUTO_DESC',
        'PRODUTO_PRECO',
        'PRODUTO_DESCONTO',
        'CATEGORIA_ID',
        'PRODUTO_ATIVO',
    ];

    protected $primaryKey = 'PRODUTO_ID';
    protected $foreignKey = 'CATEGORIA_ID';
  
    protected $table = 'PRODUTO';

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class, 'CATEGORIA_ID');
    }

    public function images()
    {
        return $this->hasMany(Images::class, 'PRODUTO_ID');
    }

    public function orders()
    {
        return $this->belongsToMany(Orders::class, 'PRODUTO_PEDIDO', 'PRODUTO_ID', 'PEDIDO_ID');
    }


    
   

}

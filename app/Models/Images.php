<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $fillable = [
       'IMAGEM_ID',
       'IMAGEM_ORDEM',
       'PRODUTO_ID',
       'IMAGEM_URL'
    ];

    protected $primaryKey = 'IMAGEM_ID';
    protected $foreignKey = 'PRODUTO_ID';
    protected $table = 'PRODUTO_IMAGEM';

}

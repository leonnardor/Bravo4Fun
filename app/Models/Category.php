<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'CATEGORIA_NOME',
        'CATEGORIA_DESC',
        'CATEGORIA_ATIVO',
    ];

    protected $primaryKey = 'CATEGORIA_ID';
    protected $table = 'CATEGORIA';
    
}

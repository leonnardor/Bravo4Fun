<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\orders;


class OrdersStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'STATUS_ID',
        'STATUS_DESC',
    ];

    protected $primaryKey = 'STATUS_ID';
    protected $table = 'STATUS_PEDIDO';
    
    public $timestamps = false;

    public function orders()
    {
        return $this->hasMany(Orders::class, 'STATUS_ID');
    }

}

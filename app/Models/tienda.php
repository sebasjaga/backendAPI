<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tienda extends Model
{
    use HasFactory;

    protected $table = 'tienda';
    protected $fillable = [
        'id_tienda',
        'carrito_juegos',
        'favoritos' ,
        'metodo_pago'
    ];

    
}

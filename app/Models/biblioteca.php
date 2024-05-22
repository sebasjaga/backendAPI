<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class biblioteca extends Model
{
    use HasFactory;

    protected $table = 'biblioteca';
    protected $fillable = [
        'id_biblioteca',
        'juegos_id_juegos' ,
        'juegos_usuario_id_usuario' ,
        'juegos_usuario_biblioteca_idbiblioteca' 
    ];

    
}

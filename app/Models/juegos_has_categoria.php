<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class juegos_has_categoria extends Model
{
    use HasFactory;

    protected $table = 'juegos_has_categoria';
    protected $fillable = [
        'juegos_id_juegos',
        'juegos_usuario_id_usuario' ,
        'juegos_usuario_biblioteca_idbiblioteca' ,
        'categoria_id_categoria' 
    ];

    
}

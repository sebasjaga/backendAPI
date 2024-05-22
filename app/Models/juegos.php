<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class juegos extends Model
{
    use HasFactory;

    protected $table = 'juegos';
    protected $fillable = [
        'id_juegos',
        'titulo' ,
        'etiquetas' ,
        'usuario_id_usuario' ,
        'usuario_biblioteca_idbiblioteca' 
    ];

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';
    protected $fillable = [
        'id_usuario',
        'nickname' ,
        'pais' ,
        'descripcion' ,
        'biblioteca' ,
        'biblioteca_idbiblioteca' ,
        'roles_id_roles' ,
        'biblioteca_id_biblioteca' ,
        'biblioteca_juegos_id_juegos' ,
        'biblioteca_juegos_usuario_id_usuario' ,
        'biblioteca_juegos_usuario_biblioteca_idbiblioteca' 

    ]; 

    
}

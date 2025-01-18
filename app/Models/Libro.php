<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $fillable = [
        'nombre_del_libro',
        'nombre_del_autor',
        'género_literario',
        'ISBN',
        'editorial',
        'idioma',
        'nacionalidad',
        'código_del_autor',
        'número_de_páginas',
        'casilla_disponibilidad',
        'cantidad',
        'comentario',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{

    // protected $table = 'libros';

    protected $fillable = [
        'nombre_del_libro',
        'nombre_del_autor',
        // 'género_literario',
        'ISBN',
        'editorial',
        'idioma',
        'nacionalidad',
        'código_del_autor',
        'número_de_páginas',
        'casilla_disponibilidad',
        'cantidad',
        'comentario',
        'categoria_id'
    ];


    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'libro_id'); // 'libro_id' es la clave foránea en la tabla prestamos
    }
    public function categoria()
{
    return $this->belongsTo(Categoria::class);
}
}

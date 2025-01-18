<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $fillable = [
        'nombre_del_usuario',
        'dirección',
        'barrio',
        'ciudad',
        'teléfono',
        'nombre_del_libro',
        'asignatura',
        'fecha_de_prestamo',
        'fecha_de_devolución',
        'sancionado',
        'código_del_libro',
    ];
}

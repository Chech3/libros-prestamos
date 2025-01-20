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
        'libro_id',
        'asignatura',
        'fecha_de_prestamo',
        'fecha_de_devolución',
        'sancionado',
        'código_del_libro',
    ];


    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id'); // 'libro_id' es la clave foránea
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destinario extends Model
{
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'direccion',
    ];

    public function prestamo()
    {
        return $this->hasMany(Prestamo::class, "destinario_id");
    }
}

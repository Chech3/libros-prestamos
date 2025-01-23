<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    // Relación uno a muchos con Libros
    public function libros()
    {
        return $this->hasMany(Libro::class);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_del_usuario');
            $table->string('dirección');
            $table->string('barrio');
            $table->string('ciudad');
            $table->string('teléfono');
            $table->string('nombre_del_libro');
            $table->string('asignatura')->nullable();
            $table->date('fecha_de_prestamo');
            $table->date('fecha_de_devolución');
            $table->boolean('sancionado')->default(false);
            $table->integer('código_del_libro');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};

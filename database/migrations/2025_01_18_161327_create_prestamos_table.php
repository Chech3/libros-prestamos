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
            // $table->string('nombre_del_usuario');
            $table->unsignedBigInteger('libro_id'); // Relación con libros
            $table->string('asignatura')->nullable();
            $table->date('fecha_de_prestamo');
            $table->date('fecha_de_devolución');
            $table->boolean('sancionado')->default(false);
            // $table->integer('código_del_libro');
            $table->timestamps();
            
            $table->unsignedBigInteger('destinario_id')->nullable();
            $table->foreign('destinario_id')->references('id')->on('destinarios')->onDelete('cascade');

            $table->foreign('libro_id')->references('id')->on('libros')->onDelete('cascade');
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

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
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_del_libro');
            $table->string('nombre_del_autor');
            $table->string('género_literario');
            $table->string('ISBN')->unique(); // ISBN único
            $table->string('editorial');
            $table->string('idioma');
            $table->string('nacionalidad');
            $table->integer('código_del_autor');
            $table->integer('número_de_páginas');
            $table->boolean('casilla_disponibilidad')->default(true);
            $table->integer('cantidad');
            $table->text('comentario')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};

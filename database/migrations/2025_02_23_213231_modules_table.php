<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id(); // id (autoincremental)
            $table->unsignedBigInteger('menuId')->nullable(); // ID del menú (puede ser nulo para módulos principales)
            $table->string('page')->nullable();; // Página del módulo
            $table->string('titulo'); // Título del módulo
            $table->string('icono')->nullable(); // Icono del módulo
            $table->text('descripcion')->nullable(); // Descripción
            $table->integer('status')->default(1); // Estado (por defecto activo)

            // Agregar clave foránea para menuId si existe
            $table->foreign('menuId')->references('id')->on('modules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->dropForeign(['menuId']);
        });

        Schema::dropIfExists('modules');
    }
};

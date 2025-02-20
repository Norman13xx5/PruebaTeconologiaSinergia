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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id(); // id (autoincremental)
            $table->unsignedBigInteger('rolId'); // ID del rol
            $table->unsignedBigInteger('moduloId'); // ID del módulo
            $table->integer('r')->default(0); // Permiso de lectura
            $table->integer('w')->default(0); // Permiso de escritura
            $table->integer('u')->default(0); // Permiso de actualización
            $table->integer('d')->default(0); // Permiso de eliminación

            // Agregar claves foráneas
            $table->foreign('rolId')->references('id')->on('role')->onDelete('cascade');
            $table->foreign('moduloId')->references('id')->on('modules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropForeign(['rolId']);
            $table->dropForeign(['moduloId']);
        });

        Schema::dropIfExists('permissions');
    }
};
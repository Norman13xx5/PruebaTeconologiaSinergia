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
        Schema::create('role', function (Blueprint $table) {
            $table->id(); // id (autoincremental)
            $table->string('nombreRol'); // Nombre del Rol
            $table->text('descripcion')->nullable(); // Descripción
            $table->integer('status')->default(1); // Estado (por defecto activo)
            $table->timestamps(); // created_at y updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('role');
    }
};

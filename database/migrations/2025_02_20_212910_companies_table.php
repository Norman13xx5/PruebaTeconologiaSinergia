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
        Schema::create('companies', function (Blueprint $table) {
            $table->id(); // id (autoincremental, solo si no se usa nit como id)
            $table->integer('nit')->unique(); // NIT como clave primaria
            $table->integer('digito')->nullable(); // Dígito
            $table->string('nombre'); // Nombre
            $table->string('representante')->nullable(); // Representante
            $table->string('telefono')->nullable(); // Teléfono
            $table->string('direccion')->nullable(); // Dirección
            $table->string('correo')->nullable(); // Correo
            $table->string('pais')->nullable(); // País
            $table->string('ciudad')->nullable(); // Ciudad
            $table->string('contacto')->nullable(); // Contacto
            $table->string('emailTec')->nullable(); // Email Técnico
            $table->string('emailLogis')->nullable(); // Email Logístico
            $table->string('contentType')->nullable(); // Content Type
            $table->text('base64')->nullable(); // Base64
            $table->date('fechaInicio')->nullable(); // Fecha de Inicio
            $table->date('fechaCorte')->nullable(); // Fecha de Corte
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
        Schema::dropIfExists('companies');
    }
};

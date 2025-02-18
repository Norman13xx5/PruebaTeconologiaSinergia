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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // id (autoincremental)
            $table->integer('nit')->unique(); // NIT
            $table->string('identificacion')->unique(); // Identificación
            $table->string('nombres'); // Nombres
            $table->string('aPaterno'); // Apellido Paterno
            $table->string('aMaterno'); // Apellido Materno
            $table->string('telefono')->nullable(); // Teléfono
            $table->string('emailUser')->unique(); // Email
            $table->string('pswd'); // Contraseña
            $table->string('nombreFiscal'); // Nombre Fiscal
            $table->string('direccionFiscal'); // Dirección Fiscal
            $table->string('contentType')->nullable(); // Content Type
            $table->text('base64')->nullable(); // Base64
            $table->unsignedBigInteger('rolId'); // Rol ID
            $table->integer('status')->default(1); // Estado (por defecto activo)
            $table->timestamps(); // created_at y updated_at
            $table->softDeletes(); // deleted_at
        });

        // Agregar una clave foránea para rolId
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('rolId')->references('id')->on('role')->onDelete('cascade');
        });

        // Agregar una clave foránea para nit (si existe la tabla empresa)
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('nit')->references('nit')->on('companies')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['rolId']);
            $table->dropForeign(['nit']);
        });

        Schema::dropIfExists('users');
    }
};

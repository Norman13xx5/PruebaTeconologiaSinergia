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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_documento_id')->nullable();
            $table->string('numero_documento')->nullable();
            $table->string('nombre1')->nullable();
            $table->string('nombre2')->nullable();
            $table->string('apellido1')->nullable();
            $table->string('apellido2')->nullable();
            $table->unsignedBigInteger('genero_id')->nullable();
            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->unsignedBigInteger('municipio_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tipo_documento_id')->references('id')->on('typesids')->onDelete('cascade');
            $table->foreign('genero_id')->references('id')->on('genres')->onDelete('cascade');
            $table->foreign('departamento_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('municipio_id')->references('id')->on('municipalities')->onDelete('cascade');
            $table->integer('status')->default(1);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign(['tipo_documento_id']);
        });
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign(['genero_id']);
        });
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign(['departamento_id']);
        });
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign(['municipio_id']);
        });

        Schema::dropIfExists('patients');
    }
};

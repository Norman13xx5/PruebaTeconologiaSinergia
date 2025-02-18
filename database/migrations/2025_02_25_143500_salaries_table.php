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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id(); // id (autoincremental)
            $table->foreignId('userId');
            $table->string('description');
            $table->decimal('amount', 15, 2);
            $table->integer('status')->default(1); // Estado (por defecto activo)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('salaries');
    }
};

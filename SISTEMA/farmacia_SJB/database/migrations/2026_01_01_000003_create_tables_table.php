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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('table_number', 50)->unique(); // Ej: "Mesa 01", "Barra 02"
            $table->integer('capacity')->default(4); // Cantidad de comensales permitidos
            $table->enum('status', ['available', 'occupied', 'reserved'])->default('available'); // Estado en tiempo real
            $table->enum('location', ['main_hall', 'terrace', 'bar', 'delivery'])->default('main_hall'); // Mejora comercial: Zonas del local
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
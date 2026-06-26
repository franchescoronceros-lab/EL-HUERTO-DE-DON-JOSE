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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->enum('document_type', ['DNI', 'RUC', 'CE'])->default('DNI'); // Tipo de documento legal
            $table->string('document_number', 15)->unique(); // Número único de identidad fiscal
            $table->string('name'); // Nombre completo o Razón Social
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable(); // Necesario para la emisión de Facturas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
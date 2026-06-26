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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique(); // Formato comercial: Ej. T001-000001
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('table_id')->constrained('tables')->onDelete('restrict');
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('restrict'); // Nullable para "Clientes Varios"
            $table->string('customer_name')->default('Clientes Varios');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('igv_percentage', 5, 2)->default(18.00); // Congela el impuesto del momento por auditoría contable
            $table->decimal('igv', 10, 2);
            $table->decimal('total', 10, 2);
            $table->enum('status', ['pending', 'in_kitchen', 'ready', 'delivered', 'paid', 'cancelled'])->default('pending');
            $table->enum('payment_method', ['cash', 'card', 'yape_plin'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
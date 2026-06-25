<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallSaleTable extends Migration
{
    public function up()
    {
        Schema::create('detall_sale', function (Blueprint $table) {

            $table->id();

            $table->foreignId('sale_id')
                  ->constrained('sales')
                  ->onDelete('cascade');

            $table->foreignId('medicine_id')
                  ->constrained('medicines')
                  ->onDelete('cascade');

            $table->integer('amount');

            $table->decimal('price_unit', 8, 2);

            $table->decimal('subtotal', 8, 2);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detall_sale');
    }
}
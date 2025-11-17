<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customer_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('customer_orders')->cascadeOnDelete();
            $table->foreignId('customer_product_id')->constrained('customer_products')->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('price',10,2);
            $table->decimal('total',10,2)->storedAs('quantity * price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_order_items');
    }
};


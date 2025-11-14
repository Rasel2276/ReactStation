<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_stock_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('vendor_id');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->text('details')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['Active','Inactive'])->default('Active');
            $table->timestamp('created_at')->useCurrent();

            // Foreign keys
            $table->foreign('vendor_stock_id')->references('id')->on('vendor_stock')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_products');
    }
};


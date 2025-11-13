<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('supplier_purchase_returns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_purchase_id');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->string('status')->default('Pending');
            $table->text('reason')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('admin_purchase_id')->references('id')->on('admin_purchases')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supplier_purchase_returns');
    }
};


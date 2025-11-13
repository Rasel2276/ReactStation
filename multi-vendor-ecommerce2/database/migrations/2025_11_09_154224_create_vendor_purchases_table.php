<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendor_purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('admin_stock_id');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('total', 10, 2)->storedAs('quantity * price');
            $table->enum('status', ['Pending','Completed','Cancelled','Allocated'])->default('Pending');
            $table->timestamp('purchase_date')->useCurrent();
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('admin_stock_id')->references('id')->on('admin_stock')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_purchases');
    }
};


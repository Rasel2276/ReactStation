<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // পুরনো table drop করে নতুন table create করা
        Schema::dropIfExists('admin_purchases');

        Schema::create('admin_purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('purchase_price', 10, 2);
            $table->decimal('vendor_sale_price', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0); // storedAs বাদ দিয়ে default 0
            $table->enum('status', ['Pending', 'Completed', 'Cancelled'])->default('Pending');
            $table->string('payment_method')->nullable(); // after() remove করা হলো
            $table->timestamp('purchase_date')->useCurrent();
            $table->timestamps();

            // Foreign keys
            $table->foreign('admin_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->cascadeOnDelete();
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_purchases');
    }
};

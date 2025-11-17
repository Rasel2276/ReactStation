<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('guest_id')->nullable()->constrained('guest_customers')->nullOnDelete();
            $table->decimal('subtotal',10,2);
            $table->decimal('shipping_cost',10,2)->default(0);
            $table->decimal('total_payment',10,2);
            $table->string('shipping_method')->default('Free Shipping');
            $table->string('payment_method')->default('Direct Bank Transfer');
            $table->enum('status', ['Pending','Processing','Completed','Cancelled'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_orders');
    }
};


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_discounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->enum('discount_for',['Customer','Vendor','Supplier'])->default('Customer');
            $table->enum('discount_type',['Percentage','Fixed Amount']);
            $table->decimal('discount_value',10,2);
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status',['Active','Inactive'])->default('Active');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_discounts');
    }
};


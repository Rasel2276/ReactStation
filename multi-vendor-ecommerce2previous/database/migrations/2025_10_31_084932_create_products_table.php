<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('sku')->nullable()->unique();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->decimal('base_price', 12, 2)->nullable();
            $table->text('description')->nullable();
            $table->string('product_image')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->enum('featured', ['Yes','No'])->default('No');
            $table->enum('status', ['Active','Inactive'])->default('Active');
            $table->timestamps();

            // optional foreign keys (uncomment if you want strict FKs)
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('set null');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

public function up(): void
{
    Schema::create('vendor_stock', function (Blueprint $table) {
        $table->id();
        $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('admin_stock_id')->constrained('admin_stock')->onDelete('cascade');
        $table->integer('quantity');
        $table->decimal('price', 10, 2);
        $table->enum('status', ['Available','Sold Out'])->default('Available');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('vendor_stocks');
    }
};

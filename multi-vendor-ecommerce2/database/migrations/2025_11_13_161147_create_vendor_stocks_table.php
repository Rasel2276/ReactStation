<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('vendor_stock', function (Blueprint $table) {
        $table->id();
        
        // Foreign Keys (users এবং admin_stock টেবিলের সাথে সম্পর্ক)
        $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('admin_stock_id')->constrained('admin_stock')->onDelete('cascade');
        
        // মূল ফিল্ডস
        $table->integer('quantity');
        $table->decimal('price', 10, 2);
        
        // Status
        $table->enum('status', ['Available','Sold Out'])->default('Available');
        
        $table->timestamps(); // created_at এবং updated_at এর জন্য
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_stocks');
    }
};

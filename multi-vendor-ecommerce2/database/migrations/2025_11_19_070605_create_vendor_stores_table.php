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
        Schema::create('vendor_stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade'); // Assuming 'users' is the table for vendors
            $table->string('store_name', 150)->unique(); // Added unique constraint for store name
            $table->string('store_logo', 255)->nullable();
            $table->string('store_banner', 255)->nullable();
            $table->text('store_description')->nullable();
            $table->text('store_address')->nullable(); // Added address field from the form
            $table->string('store_email')->nullable(); // Added email field from the form
            $table->string('store_phone')->nullable(); // Added phone field from the form
            $table->enum('store_status', ['Active','Inactive'])->default('Active');
            $table->timestamps(); // Created_at and updated_at
        });
    }

    /**
     * Reverse the migrationsssss.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_stores');
    }
};

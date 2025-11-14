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
    Schema::create('vendor_returns', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('vendor_id');
        $table->unsignedBigInteger('admin_id');
        $table->unsignedBigInteger('product_id');
        $table->integer('quantity');
        $table->text('reason')->nullable();
        $table->enum('status',['Pending','Approved','Rejected','Completed'])->default('Pending');
        $table->timestamp('return_date')->useCurrent();

        $table->foreign('vendor_id')->references('id')->on('users');
        $table->foreign('admin_id')->references('id')->on('users');
        $table->foreign('product_id')->references('id')->on('products');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_returns');
    }
};

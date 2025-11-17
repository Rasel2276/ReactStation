<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('guest_customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('company_name')->nullable();
            $table->string('country');
            $table->string('street_address');
            $table->string('street_address2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('postcode');
            $table->text('order_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guest_customers');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->integer('sum')->nullable();
            $table->foreignId('shipping_address_id')->nullable()->constrained('addresses');
            $table->foreignId('shipping_method_id')->nullable()->constrained('shipping_methods');
            $table->timestamp('date')->nullable();
            $table->foreignId('status_id')->nullable()->constrained('order_statuses');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

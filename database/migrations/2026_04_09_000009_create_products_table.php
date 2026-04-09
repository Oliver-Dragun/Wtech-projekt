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
            $table->foreignId('product_type_id')->constrained('product_types');
            $table->foreignId('size_id')->constrained('sizes');
            $table->integer('price');
            $table->boolean('is_bundle');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

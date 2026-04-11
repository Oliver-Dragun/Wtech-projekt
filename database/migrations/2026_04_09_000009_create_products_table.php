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
            $table->string('name', 255);
            $table->text('description');
            $table->foreignId('category_id')->constrained('product_categories');
            $table->string('effect', 63);
            $table->string('grade', 31);
            $table->integer('price');
            $table->boolean('is_bundle')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

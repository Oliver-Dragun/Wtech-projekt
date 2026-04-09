<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bundle_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bundle_product_id')->constrained('products');
            $table->foreignId('component_product_id')->constrained('products');
            $table->smallInteger('quantity');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bundle_components');
    }
};

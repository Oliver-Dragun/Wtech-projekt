<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_effects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('effect_id')->constrained('effects');
            $table->foreignId('product_type_id')->constrained('product_types');
            $table->smallInteger('strength');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_effects');
    }
};

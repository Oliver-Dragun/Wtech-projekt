<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('product_type_id')->constrained('product_types');
            $table->text('body');
            $table->smallInteger('rating');
            $table->timestamp('date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

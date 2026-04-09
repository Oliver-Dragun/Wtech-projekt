<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street_address', 255);
            $table->string('apartment', 127)->nullable();
            $table->string('city', 127);
            $table->string('postal_code', 15);
            $table->string('country', 127);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};

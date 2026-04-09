<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_effects', function (Blueprint $table) {
            $table->string('strength', 31)->change();
        });
    }

    public function down(): void
    {
        Schema::table('product_effects', function (Blueprint $table) {
            $table->smallInteger('strength')->change();
        });
    }
};

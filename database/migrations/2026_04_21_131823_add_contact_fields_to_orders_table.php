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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('name', 63)->nullable()->after('user_id');
            $table->string('surname', 63)->nullable()->after('name');
            $table->string('email', 127)->nullable()->after('surname');
            $table->string('phone_number', 31)->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['name', 'surname', 'email', 'phone_number']);
        });
    }
};

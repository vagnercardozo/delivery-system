<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->time('opening_time')->nullable()->change();
            $table->time('closing_time')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dateTime('opening_time')->nullable()->change();
            $table->dateTime('closing_time')->nullable()->change();
        });
    }
};

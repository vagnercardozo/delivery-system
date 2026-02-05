<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->string('ifood_merchant_id')->nullable()->index();
            $table->string('ifood_token')->nullable();
            $table->boolean('ifood_enabled')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn('ifood_merchant_id');
            $table->dropColumn('ifood_token');
            $table->dropColumn('ifood_enabled');
        });
    }
};

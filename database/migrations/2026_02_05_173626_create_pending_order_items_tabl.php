<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pending_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pending_order_id')->constrained('pending_orders')->cascadeOnDelete();
            $table->string('external_product_id');
            $table->string('external_product_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pending_order_items');
    }
};

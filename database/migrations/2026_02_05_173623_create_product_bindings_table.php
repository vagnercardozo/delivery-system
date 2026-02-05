<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_bindings', function (Blueprint $table) {
            $table->id();
            $table->enum('provider', ['IFOOD'])->default('IFOOD');
            $table->foreignId('restaurant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('external_product_id');
            $table->string('external_product_name');
            $table->timestamps();
            $table->unique(['provider', 'external_product_id']);
            $table->unique(['provider', 'restaurant_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_bindings');
    }
};

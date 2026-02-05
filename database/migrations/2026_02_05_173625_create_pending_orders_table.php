<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pending_orders', function (Blueprint $table) {
            $table->id();
            $table->enum('provider', ['IFOOD'])->default('IFOOD');
            $table->foreignId('restaurant_id')->constrained()->cascadeOnDelete();
            $table->string('external_order_id');
            $table->json('payload');
            $table->string('reason');
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
            $table->index(['provider', 'external_order_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pending_orders');
    }
};

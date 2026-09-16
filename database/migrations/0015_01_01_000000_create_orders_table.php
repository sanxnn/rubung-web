<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('custom_order_id')->nullable()->constrained('custom_orders')->nullOnDelete();
            $table->string('order_number', 100)->unique();
            $table->string('shipping_name', 255);
            $table->string('shipping_phone', 20);
            $table->text('shipping_address');
            $table->string('shipping_city', 100);
            $table->string('shipping_province', 100);
            $table->string('shipping_postal_code', 10);
            $table->decimal('subtotal', 19, 2);
            $table->decimal('discount_amount', 19, 2)->default(0);
            $table->decimal('total', 19, 2);
            $table->enum('dp_type', ['percentage', 'fixed'])->nullable();
            $table->decimal('dp_value', 19, 2)->nullable();
            $table->decimal('dp_amount', 19, 2)->nullable();
            $table->decimal('paid_amount', 19, 2)->default(0);
            $table->decimal('remaining_amount', 19, 2);
            $table->enum('payment_status', ['pending', 'paid', 'partial'])->default('pending');
            $table->enum('status', ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'completed', 'cancelled'])->default('pending');
            $table->date('agreed_delivery_date');
            $table->json('snapshot_promo')->nullable();
            $table->json('snapshot_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

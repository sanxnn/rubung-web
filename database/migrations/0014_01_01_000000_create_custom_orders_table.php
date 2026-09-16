<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->string('customer_name', 255);
            $table->string('customer_phone', 20);
            $table->text('description');
            $table->string('design_image_url', 500)->nullable();
            $table->decimal('requested_price', 19, 2)->nullable();
            $table->decimal('admin_price', 19, 2)->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected', 'converted'])->default('pending');
            $table->text('admin_note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_orders');
    }
};

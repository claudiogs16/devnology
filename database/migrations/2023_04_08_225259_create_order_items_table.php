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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');

            $table->integer('product_id');
            $table->integer('supplier_id');

            $table->string('name');
            $table->text('description');
            $table->string('category')->default(null);
            $table->string('department')->default(null);
            $table->string('material')->default(null);
            $table->integer('price');
            $table->integer('discountValue')->default(0);
            $table->boolean('hasDiscount')->default(false);
            $table->json('details')->default(null);




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

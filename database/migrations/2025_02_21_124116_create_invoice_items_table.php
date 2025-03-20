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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoiceId');
            $table->unsignedBigInteger('productId')->nullable(); // Allow NULL for custom products
            $table->string('productName'); // Store custom product name if not in products table
            $table->integer('quantity');
            $table->decimal('unitPrice', 10, 2);
            $table->decimal('totalPrice', 10, 2);
            $table->timestamps();
            $table->foreign('productId')->references('id')->on('products')->onDelete('set null');

            $table->foreign('invoiceId')->references('id')->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};

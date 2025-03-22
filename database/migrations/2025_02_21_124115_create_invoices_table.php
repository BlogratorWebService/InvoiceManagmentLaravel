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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoiceNumber')->unique();
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('customerId');
            $table->date('invoiceDate');
            $table->decimal('totalAmount', 10, 2);
            $table->decimal('cGst', 4, 2)->default(0);
            $table->decimal('sGst', 4, 2)->default(0);
            $table->decimal('iGst', 4, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('grandTotal', 10, 2);
            $table->enum('status', ['unpaid', 'paid', 'cancelled'])->default('unpaid');
          
            $table->timestamps();

            $table->foreign('customerId')->references('id')->on('customers')->onDelete('cascade');
   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

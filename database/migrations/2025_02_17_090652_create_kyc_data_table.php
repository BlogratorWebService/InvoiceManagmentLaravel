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
        Schema::create('kyc_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users');
            $table->string('panNumber')->nullable()->unique();
            $table->string('GSTIN')->nullable()->unique();
            $table->string('state');
            $table->string('city');
            $table->string('fullAddress');
            $table->string('pinCode');
            $table->string('GSTINApiLog')->nullable();
            $table->string('panApiLog')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kyc_data');
    }
};

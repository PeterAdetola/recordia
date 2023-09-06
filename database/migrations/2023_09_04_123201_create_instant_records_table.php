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
        Schema::create('instant_records', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('purpose');
            $table->integer('amount');
            $table->boolean('transaction');
            $table->integer('payment_mode');
            $table->boolean('payment_status');
            $table->boolean('verified')->nullable();
            $table->string('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instant_records');
    }
};

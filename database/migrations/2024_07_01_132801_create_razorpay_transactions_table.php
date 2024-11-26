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
        Schema::create('razorpay_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deposit_id')->default(0)->unique()->nullable();
            $table->string('razorpay_payment_id')->unique()->nullable();
            $table->string('razorpay_order_id')->unique()->nullable();
            $table->string('razorpay_signature')->unique()->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
            $table->foreign('deposit_id')
                ->references('id')
                ->on('deposits')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('razorpay_transactions');
    }
};

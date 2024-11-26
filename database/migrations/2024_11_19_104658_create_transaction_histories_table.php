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
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deposit_id');
            $table->string('transaction_no')->unique()->nullable();
            $table->string('payment_method', 100);
            $table->double('paid_amount', 18, 2);
            $table->text('payment_response')->nullable();
            $table->text('remarks')->nullable();
            $table->string('upload_file')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->foreign('deposit_id')->references('id')->on('deposits')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_histories');
    }
};

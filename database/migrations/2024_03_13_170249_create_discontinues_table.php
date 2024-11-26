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
        Schema::create('discontinues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subscription_id')->default(0);
            $table->double('final_amount', 16, 2)->default(0.00)->nullable();
            $table->double('settlement_amount', 16, 2)->default(0.00)->nullable();
            $table->date('paid_on')->nullable();
            $table->longText('reason')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('subscription_id')
                ->references('id')
                ->on('user_subscriptions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discontinues');
    }
};

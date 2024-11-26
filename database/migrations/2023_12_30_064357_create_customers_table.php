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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('mobile')->unique()->nullable()->default(0);
            $table->string('password');
            $table->string('referrel_code')->unique()->nullable()->default(0);
            $table->string('aadhar_number')->unique()->nullable();
            $table->string('otp')->nullable()->default(0);
            $table->tinyInteger('is_verified')->default(0);
            $table->tinyInteger('status')->default(1);

            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

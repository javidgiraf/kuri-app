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
        Schema::table('customers', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('countries', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('states', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('districts', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('address', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('nominees', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('schemes', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('user_subscriptions', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('districts');
        Schema::dropIfExists('address');
        Schema::dropIfExists('nominees');
        Schema::dropIfExists('schemes');
        Schema::dropIfExists('user_subscriptions');
    }
};

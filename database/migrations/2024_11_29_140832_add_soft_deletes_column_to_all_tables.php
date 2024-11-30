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
            $table->softDeletes();
        });
        Schema::table('countries', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('states', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('districts', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('address', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('nominees', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('schemes', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('scheme_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('scheme_settings', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('bank_transfers', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('log_activities', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('gold_rates', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('gold_deposits', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('countries', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('states', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('districts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('address', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('nominees', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('schemes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('scheme_types', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('scheme_settings', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('bank_transfers', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('log_activities', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('gold_rates', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('gold_deposits', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};

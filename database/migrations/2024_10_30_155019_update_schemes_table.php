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
        Schema::table('schemes', function (Blueprint $table) {
            $table->dropColumn('total_amount');
            $table->dropColumn('schedule_amount');
            $table->integer('scheme_type_id')->after('total_period');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schemes', function (Blueprint $table) {
            $table->double('total_amount', 16, 2)->default(0.00)->nullable();
            $table->double('schedule_amount', 16, 2)->default(0.00)->nullable();
            $table->dropColumn('scheme_type_id');
        });
    }
};

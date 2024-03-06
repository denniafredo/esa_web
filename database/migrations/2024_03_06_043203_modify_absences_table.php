<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('absences', function (Blueprint $table) {
            $table->time('time_in')->nullable()->change(); // Make time_in nullable
            $table->time('time_out')->nullable()->change(); // Make time_out nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absences', function (Blueprint $table) {
            $table->time('time_in')->change(); // Make time_in nullable
            $table->time('time_out')->change(); // Make time_out nullable
        });
    }
};

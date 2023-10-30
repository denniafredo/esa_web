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
        Schema::create('history_leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employment_id');
            $table->date('date_leave');
            $table->text('reason')->nullable();
            $table->timestamps();

            $table->foreign('employment_id')->references('id')->on('employments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_leaves');
    }
};

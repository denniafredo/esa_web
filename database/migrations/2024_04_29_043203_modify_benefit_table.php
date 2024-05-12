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
        Schema::dropIfExists('benefits');
        Schema::create('benefits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employment_id');
            $table->integer('day_of_works')->default(19);
            $table->integer('performance_allowances')->default(0);
            $table->integer('leaves')->default(0);
            $table->integer('sick_leaves')->default(0);
            $table->integer('absence_leaves')->default(0);
            $table->integer('basic_salary')->default(0);
            $table->integer('meal_allowances')->default(0);
            $table->integer('transport_allowances')->default(0);
            $table->integer('persenpph')->default(5);
            $table->integer('burden')->default(0);
            $table->string('no_account')->nullable();
            $table->string('periode')->nullable();
            $table->timestamps();

            $table->foreign('employment_id')->references('id')->on('employments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benefits');
    }
};

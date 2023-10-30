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
        Schema::create('employments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['Pria', 'Wanita']);
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('type_of_blood',2)->nullable();
            $table->string('nik')->unique();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->enum('religion', ['Islam', 'Kristen','Katolik','Budha','Hindu','Konghucu'])->nullable();
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('zip_code')->nullable();
            $table->text('address')->nullable();
            $table->string('image_path')->nullable();
            $table->date('date_start_of_work')->nullable();
            $table->integer('leave_quota')->nullable();
            $table->unsignedBigInteger('employment_status_id');
            $table->unsignedBigInteger('employment_division_id');
            $table->unsignedBigInteger('employment_role_id');
            $table->timestamps();

            $table->foreign('employment_status_id')->references('id')->on('employment_statuses');
            $table->foreign('employment_division_id')->references('id')->on('employment_divisions');
            $table->foreign('employment_role_id')->references('id')->on('employment_roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employments');
    }
};

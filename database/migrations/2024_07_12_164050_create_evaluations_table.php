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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hr_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->float('certification')->nullable();
            $table->float('pengalaman')->nullable();
            $table->float('pendidikan')->nullable();
            $table->float('hardskill')->nullable();
            $table->integer('job_id')->nullable();
            $table->timestamps();
            $table->foreign('hr_id')->references('id')->on('users');
            $table->foreign('employee_id')->references('id')->on('users');
            // $table->foreign('job_id')->references('id')->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};

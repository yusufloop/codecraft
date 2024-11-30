<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Foreign key for the user
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('ic_num')->nullable();
            $table->string('age')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('experience')->nullable();
            $table->string('education')->nullable();
            $table->string('skill_set')->nullable();
            $table->string('resume_path')->nullable(); // Store resume file path
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};

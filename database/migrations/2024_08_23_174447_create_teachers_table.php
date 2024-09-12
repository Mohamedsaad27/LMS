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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('school_id')->nullable()->index();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('set null')->onUpdate('set null');
            $table->date('hire_date')->nullable();
            $table->string('qualification', 255)->nullable();
            $table->string('subject_specialization', 255)->nullable();
            $table->integer('experience_years')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active')->index();
            $table->string('photo', 255)->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};

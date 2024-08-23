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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('publishing_house_id')->nullable();
            $table->foreign('publishing_house_id')->references('id')->on('publishing_houses')->cascadeOnDelete();
            $table->date('established_year')->nullable();
            $table->text('description',455)->nullable();
            $table->smallInteger('student_count')->nullable();
            $table->smallInteger('teacher_count')->nullable();
            $table->string('logo',100)->nullable();
            $table->enum('type',['primary','secondary','high_school'])->default('primary')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};

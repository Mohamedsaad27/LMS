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
        Schema::create('student_badges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('badge_id')->nullable();
            $table->timestamp('awarded_at')->useCurrent();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('set null');
            $table->foreign('badge_id')->references('id')->on('badges')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_badges');
    }
};

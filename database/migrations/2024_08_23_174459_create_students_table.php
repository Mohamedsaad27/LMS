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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('school_id')->nullable()->default(null);
            $table->date('date_of_birth')->nullable();
            $table->date('enrollment_date')->nullable();
            $table->string('grade', 50)->nullable();
            $table->string('parent_contact', 20)->nullable();
            $table->string('photo', 255)->nullable();
            $table->timestamps();
//            add fk from grades
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->onUpdate('set null');
            $table->foreign('school_id')->references('id')->on('schools')->cascadeOnDelete()->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

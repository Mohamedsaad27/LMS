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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name_en',100);
            $table->string('name_ar',100);
            $table->string('email',100)->unique();
            $table->string('password',100);
            $table->string('phone',100)->nullable();
            $table->string('address',100)->nullable();
            $table->string('logo',100)->nullable();
            $table->year('established_year')->nullable();
            $table->text('description_en',455)->nullable();
            $table->text('description_ar',455)->nullable();
            $table->smallInteger('total_books')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publishing_houses');
    }
};

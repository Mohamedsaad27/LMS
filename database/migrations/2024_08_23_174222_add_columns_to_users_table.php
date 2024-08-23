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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('user_type_id')->index()->after('password');
            $table->foreign('user_type_id')->references('id')->on('user_types');
            $table->enum('gender', ['male', 'female'])->after('user_type_id');
            $table->string('address')->nullable()->after('gender');
            $table->string('phone')->nullable()->after('address');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

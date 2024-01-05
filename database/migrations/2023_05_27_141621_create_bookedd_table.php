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
        Schema::create('bookedd', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('profile_user_id');
            $table->unsignedBigInteger('re_mang_sys_id');
            $table->unsignedBigInteger('table_id');
            $table->dateTime('date');
            $table->integer('time_booked');
            $table->timestamps();

            $table->foreign('profile_user_id')->references('id')->on('profile_user')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('re_mang_sys_id')->references('id')->on('re_mang_sys')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookedd');
    }
};

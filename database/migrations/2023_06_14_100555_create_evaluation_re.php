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
        Schema::create('evaluation_re', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('re_mang_sys_id')->unsigned();
            $table->integer('love');
            $table->timestamps();
            $table->foreign('re_mang_sys_id')->references('id')->on('re_mang_sys')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_re');
    }
};

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
        Schema::create('sub_place', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('re_mang_sys_id')->unsigned();
            $table->string('name_country');
            $table->string('name_city');
            $table->string('name_region');
            $table->string('name_street');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('re_mang_sys_id')->references('id')->on('re_mang_sys')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_place');
    }
};

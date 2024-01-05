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
        Schema::create('fav_sub', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('favourity_id')->unsigned();
            $table->bigInteger('sub_category_id')->unsigned();
            $table->timestamps();
            $table->foreign('favourity_id')->references('id')->on('favourity')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub_category_id')->references('id')->on('sub_category')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fav_sub');
    }
};

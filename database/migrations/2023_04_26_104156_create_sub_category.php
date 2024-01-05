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
        Schema::create('sub_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('main_category_id')->unsigned();
            $table->string('name');
            $table->integer('price');
            $table->string('image');
            $table->text('description');
            $table->timestamps();
            $table->foreign('main_category_id')->references('id')->on('main_category')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_category');
    }
};

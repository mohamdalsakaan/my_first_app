<?php

use App\Models\table;
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
        Schema::create('favourity', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('profile_user_id')->unsigned();
            $table->timestamps();

            $table->foreign('profile_user_id')->references('id')->on('profile_user')->onDelete('cascade')->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favourity');
    }
};

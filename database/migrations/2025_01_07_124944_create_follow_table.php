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
        Schema::create('follow', function (Blueprint $table) {
            $table->id('id_follow');
            $table->unsignedBigInteger('id_following');
            $table->unsignedBigInteger('id_followed');
            $table->boolean('follow');
            $table->timestamps();

            $table->foreign('id_following')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_followed')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follow');
    }
};

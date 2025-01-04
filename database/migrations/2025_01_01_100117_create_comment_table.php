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
        Schema::create('comment', function (Blueprint $table) {
            $table->id('id_comment');
            $table->text('comment');
            $table->unsignedBigInteger('id_parent_comment')->nullable();
            $table->unsignedBigInteger('id_post');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_post')->references('id_post')->on('post')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('id_parent_comment')->references('id_comment')->on('comment')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment');
    }
};

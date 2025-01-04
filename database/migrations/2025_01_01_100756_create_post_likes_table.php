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
        Schema::create('post_likes', function (Blueprint $table) {
            $table->id('like_id');
            $table->foreignId('id_post')->constrained('post')->references('id_post')->on('post')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_users')->constrained('users')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('like')->default(true);
            $table->timestamps();

            // $table->unique(['id_post', 'id_user']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_likes');
    }
};

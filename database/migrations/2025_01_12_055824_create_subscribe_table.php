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
        Schema::create('subscribe', function (Blueprint $table) {
            $table->id('id_subscribe');
            $table->unsignedBigInteger('id_user');
            $table->string('email');
            $table->decimal('amount', 8, 2);
            $table->enum('status', ['Paid', 'Unpaid'])->default('Unpaid');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribe');
    }
};

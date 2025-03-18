<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('post', function (Blueprint $table) {
            $table->string('post_image_file_size')->nullable()->change();
            $table->string('post_image_extension')->nullable()->change();
            $table->string('post_image_size')->nullable()->change();
            $table->text('post_hashtags')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('post', function (Blueprint $table) {
            $table->string('post_image_file_size')->nullable(false)->change();
            $table->string('post_image_extension')->nullable(false)->change();
            $table->string('post_image_size')->nullable(false)->change();
            $table->text('post_hashtags')->nullable(false)->change();
        });
    }
};

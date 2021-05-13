<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('authorId')->index('users_post_fk');
            $table->unsignedBigInteger('categoryId')->index('category_post_fk');
            $table->string('title', 75);
            $table->string('metaTitle', 100);
            $table->string('featured_image');
            $table->string('slug', 100);
            $table->text('summary');
            $table->tinyInteger('published')->default(0);
            $table->dateTime('createdAt')->useCurrent();
            $table->dateTime('updatedAt')->nullable();
            $table->dateTime('publishedAt')->nullable();
            $table->text('content');
            $table->integer('hidden')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
}

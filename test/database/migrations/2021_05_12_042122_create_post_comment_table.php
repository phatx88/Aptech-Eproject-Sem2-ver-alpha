<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_comment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('postId')->index('post_fk');
            $table->unsignedBigInteger('user_id');
            $table->string('title', 100);
            $table->tinyInteger('published');
            $table->dateTime('createdAt')->useCurrent();
            $table->dateTime('publishedAt')->nullable();
            $table->text('content');
            $table->integer('star')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_comment');
    }
}

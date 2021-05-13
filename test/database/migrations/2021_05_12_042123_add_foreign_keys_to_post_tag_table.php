<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_tag', function (Blueprint $table) {
            $table->foreign('postId', 'post_post_tag')->references('id')->on('post')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('tagId', 'tag_post_tag')->references('id')->on('tag')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_tag', function (Blueprint $table) {
            $table->dropForeign('post_post_tag');
            $table->dropForeign('tag_post_tag');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post', function (Blueprint $table) {
            $table->foreign('categoryId', 'category_post_fk')->references('id')->on('post_category')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('authorId', 'users_post_fk')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post', function (Blueprint $table) {
            $table->dropForeign('category_post_fk');
            $table->dropForeign('users_post_fk');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToImageItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('image_item', function (Blueprint $table) {
            $table->foreign('product_id', 'image_item_ibfk_1')->references('id')->on('product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('image_item', function (Blueprint $table) {
            $table->dropForeign('image_item_ibfk_1');
        });
    }
}

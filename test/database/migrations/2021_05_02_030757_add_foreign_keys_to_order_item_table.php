<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_item', function (Blueprint $table) {
            $table->foreign('order_id', 'order_detail_order_fk_1')->references('id')->on('order')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('product_id', 'order_detail_product_fk_1')->references('id')->on('product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_item', function (Blueprint $table) {
            $table->dropForeign('order_detail_order_fk_1');
            $table->dropForeign('order_detail_product_fk_1');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->integer('product_id')->index('order_item_product_fk_1');
            $table->integer('order_id')->index('order_item_order_fk_1');
            $table->integer('qty');
            $table->integer('unit_price');
            $table->integer('total_price');
            $table->softDeletes();
            $table->primary(['product_id', 'order_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_item');
    }
}

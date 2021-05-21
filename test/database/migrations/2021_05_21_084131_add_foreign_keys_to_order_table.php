<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->foreign('coupon_id', 'coupon_fk')->references('id')->on('coupon')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('order_status_id', 'order_order_status_fk_1')->references('id')->on('status')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('staff_id', 'order_staff_fk_1')->references('id')->on('staff')->onUpdate('SET NULL')->onDelete('SET NULL');
            $table->foreign('customer_id', 'order_users_fk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('shipping_ward_id', 'ward_fk')->references('id')->on('ward')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropForeign('coupon_fk');
            $table->dropForeign('order_order_status_fk_1');
            $table->dropForeign('order_staff_fk_1');
            $table->dropForeign('order_users_fk_1');
            $table->dropForeign('ward_fk');
        });
    }
}

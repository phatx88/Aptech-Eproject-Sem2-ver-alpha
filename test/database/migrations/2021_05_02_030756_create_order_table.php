<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->integer('id', true);
            $table->dateTime('created_date')->useCurrent();
            $table->integer('order_status_id')->default(1)->index('order_order_status_fk_1');
            $table->unsignedBigInteger('customer_id')->nullable()->index('order_users_fk_1');
            $table->string('shipping_fullname', 100);
            $table->string('shipping_email')->nullable();
            $table->string('shipping_mobile', 15);
            $table->tinyInteger('payment_method')->default(0)->comment('0:COD, 1: bank');
            $table->integer('coupon_id')->nullable()->index('coupon_fk');
            $table->string('shipping_housenumber_street', 200);
            $table->integer('shipping_ward_id')->nullable()->index('ward_fk');
            $table->integer('shipping_fee')->nullable()->default(0);
            $table->date('delivered_date')->nullable();
            $table->integer('staff_id')->nullable()->index('order_staff_fk_1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}

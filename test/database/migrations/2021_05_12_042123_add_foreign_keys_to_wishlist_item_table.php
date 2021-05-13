<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWishlistItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wishlist_item', function (Blueprint $table) {
            $table->foreign('wish_list_id', 'wishlist_item_fk')->references('id')->on('wishlist')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('product_id', 'wishlist_product_fk')->references('id')->on('product')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wishlist_item', function (Blueprint $table) {
            $table->dropForeign('wishlist_item_fk');
            $table->dropForeign('wishlist_product_fk');
        });
    }
}

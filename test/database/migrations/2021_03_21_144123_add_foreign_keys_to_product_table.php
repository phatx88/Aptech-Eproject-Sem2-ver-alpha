<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->foreign('category_id', 'product_category_fk_1')->references('id')->on('category')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('brand_id', 'product_ibfk_1')->references('id')->on('brand')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropForeign('product_category_fk_1');
            $table->dropForeign('product_ibfk_1');
        });
    }
}

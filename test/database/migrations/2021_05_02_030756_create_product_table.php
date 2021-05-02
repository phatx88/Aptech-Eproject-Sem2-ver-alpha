<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('barcode', 13)->nullable()->unique('barcode');
            $table->string('sku', 20)->nullable();
            $table->string('name', 300);
            $table->decimal('price', 10);
            $table->integer('discount_percentage');
            $table->date('discount_from_date');
            $table->date('discount_to_date');
            $table->string('featured_image', 100);
            $table->integer('inventory_qty');
            $table->integer('category_id')->index('product_category_fk_1');
            $table->integer('brand_id')->nullable()->index('brand_id');
            $table->dateTime('created_date')->useCurrent();
            $table->text('description');
            $table->float('star', 10, 0)->nullable();
            $table->tinyInteger('featured')->nullable()->comment('1: nổi bật');
            $table->tinyInteger('hidden')->default(0);
            $table->integer('view_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}

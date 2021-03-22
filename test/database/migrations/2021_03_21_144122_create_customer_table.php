<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 100);
            $table->string('password', 32);
            $table->string('mobile', 15);
            $table->string('email', 100)->unique('email');
            $table->string('login_by', 20);
            $table->string('ward_id', 5)->nullable()->index('ward_id');
            $table->string('shipping_name', 200);
            $table->string('shipping_mobile', 15);
            $table->string('housenumber_street', 200)->nullable();
            $table->tinyInteger('is_active')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}

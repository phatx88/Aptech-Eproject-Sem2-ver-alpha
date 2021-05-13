<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_count', function (Blueprint $table) {
            $table->integer('hits')->default(0);
            $table->string('ip')->nullable();
            $table->date('date_visited')->nullable()->default('CURRENT_TIMESTAMP');
            $table->unsignedBigInteger('user_id')->nullable()->index('user_id_fk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitor_count');
    }
}

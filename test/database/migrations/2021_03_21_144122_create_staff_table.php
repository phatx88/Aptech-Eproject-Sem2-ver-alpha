<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('role_id')->index('staff_role_fk_1');
            $table->string('name', 100);
            $table->string('mobile', 15);
            $table->string('username', 100)->unique('username_2');
            $table->string('password', 32);
            $table->string('email', 100)->unique('email');
            $table->unique(['username', 'email'], 'username');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}

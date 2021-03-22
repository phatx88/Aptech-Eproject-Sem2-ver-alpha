<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_action', function (Blueprint $table) {
            $table->integer('role_id')->index('role_action_role_fk_1');
            $table->integer('action_id')->index('role_action_action_fk_1');
            $table->primary(['role_id', 'action_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_action');
    }
}

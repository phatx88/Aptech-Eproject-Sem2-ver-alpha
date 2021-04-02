<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRoleActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role_action', function (Blueprint $table) {
            $table->foreign('action_id', 'role_action_action_fk_1')->references('id')->on('action')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('role_id', 'role_action_role_fk_1')->references('id')->on('role')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_action', function (Blueprint $table) {
            $table->dropForeign('role_action_action_fk_1');
            $table->dropForeign('role_action_role_fk_1');
        });
    }
}

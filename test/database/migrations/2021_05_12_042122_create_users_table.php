<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->nullable()->unique('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('mobile', 15)->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('housenumber_street', 200)->nullable();
            $table->string('provider')->nullable()->default('form');
            $table->string('provider_id')->nullable();
            $table->integer('ward_id')->nullable()->index('ward_fk_2');
            $table->tinyInteger('is_staff')->default(0)->comment('0 - customers, 1 -staff');
            $table->tinyInteger('is_active')->default(1)->comment('0 - inActive, 1 - isActive');
            $table->timestamp('last_login_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

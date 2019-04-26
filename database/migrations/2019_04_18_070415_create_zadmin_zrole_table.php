<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZadminZroleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zadmin_zrole', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admin_id')->comment('后台登录用户Id')->default(0);
            $table->unsignedInteger('role_id')->comment('角色id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zadmin_zrole');
    }
}

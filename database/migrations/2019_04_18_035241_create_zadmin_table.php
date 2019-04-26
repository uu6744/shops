<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZadminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zadmin', function (Blueprint $table) {
            $table->increments('id')->comment('主键id');
            $table->string('name', 20)->index('name')->comment('用户名')->default('');
            $table->string('avatar',255)->comment('头像')->default('');
            $table->string('password', 100)->comment('登录密码')->default('');
            $table->char('mobile', 11)->index('mobile')->comment('电话')->default('');
            $table->ipAddress('last_login_ip')->comment('上次登录ip')->default('');
            $table->unsignedTinyInteger('status')->comment('状态:1为正常,0为冻结')->default(1);
            $table->string('token', 32)->comment('token')->default('');
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
        Schema::dropIfExists('zadmin');
    }
}

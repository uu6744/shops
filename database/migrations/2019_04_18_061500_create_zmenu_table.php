<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZmenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zmenu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50)->comment('菜单显示名称')->default('');
            $table->unsignedInteger('pid')->default(0)->comment('所属父级id');
            $table->string('icon',50)->comment('菜单logo')->default('');
            $table->string('uri',255)->comment('菜单url')->default('');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
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
        Schema::dropIfExists('zmenu');
    }
}

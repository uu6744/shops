<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZmenuZpermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zmenu_zpermission', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('permission_id')->comment('权限id')->default(0);            
            $table->unsignedInteger('menu_id')->comment('菜单Id')->default(0);
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
        Schema::dropIfExists('zmenu_zpermission');
    }
}

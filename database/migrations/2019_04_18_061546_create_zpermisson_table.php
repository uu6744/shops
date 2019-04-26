<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZpermissonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zpermisson', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',25)->comment('权限名称')->default('');
            $table->string('slug',25)->comment('权限标志')->default('');
            $table->string('url',255)->comment('菜单url')->default('');
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
        Schema::dropIfExists('zpermisson');
    }
}

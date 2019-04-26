<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spec', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100)->comment('规格名称');
            $table->string('china_name')->comment('规格中文拼音');
            $table->integer('sort')->default(0)->comment('规格排序');
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
        Schema::dropIfExists('spec');
    }
}

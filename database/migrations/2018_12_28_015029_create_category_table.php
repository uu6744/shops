<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100)->nullable()->comment('分类名称');
            $table->string('sfname',50)->nullable()->comment('分类简称');
            $table->integer('label')->default(0)->comment('分类级别 0 为第一级');
            $table->integer('parent_id')->default(0)->comment('父级分类ID');
            $table->integer('sort')->default(0)->comment('分类排序');
            $table->integer('is_show')->default(0)->comment('是否显示 0：显示；1：不显示');

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
        Schema::dropIfExists('category');
    }
}

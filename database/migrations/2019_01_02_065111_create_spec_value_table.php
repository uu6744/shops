<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spec_value', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100)->comment('规格值');
            $table->integer('spec_id')->default(0)->comment('规格ID');
            $table->integer('sort')->default(0)->comment('规格值排序');
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
        Schema::dropIfExists('spec_value');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSpecValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_spec_value', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->comment('商品ID');
            $table->string('spec_value')->commnet('该规格商品属性值');
            $table->decimal("price",5,2)->default(0)->comment('该规格售卖价格');
            $table->decimal("num",5,2)->default(0)->comment('该规格商品库存');
            $table->integer('sales_volume')->default(0)->comment('该规格商品销量');
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
        Schema::dropIfExists('product_spec_value');
    }
}

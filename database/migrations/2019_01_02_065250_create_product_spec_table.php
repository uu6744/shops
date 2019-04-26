<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSpecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_spec', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->comment('商品ID');
            $table->string('specs')->nullable()->comment('商品规格组 json格式');
            $table->string('img')->nullable()->comment('该规格商品显示图');
            $table->integer('stock')->default(0)->comment('该规格商品库存');
            $table->decimal("price",5,2)->default(0)->comment('该规格商品价格');
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
        Schema::dropIfExists('product_spec');
    }
}

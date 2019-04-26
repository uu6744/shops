<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->comment('商品分类ID');
            $table->string('name',255)->comment('商品名称');
            $table->string('sfname',100)->nullable()->comment('商品简称');
            $table->string('img',1000)->nullable()->comment('商品列表图');
            $table->string('banner',1000)->nullable()->comment('商品banner图');
            $table->decimal("price",5,2)->nullable()->comment('商品列表价格');
            $table->integer('is_sales')->defaule(0)->comment('是否下架');
            $table->integer('stock')->default(0)->comment('商品总库存');
            $table->integer('sales_volume')->default(0)->comment('商品销量');
            $table->text('detail')->nullable()->comment('商品详情');
            $table->integer('sort')->default(0)->comment('商品排序');
            $table->timestamps();
        });
        DB::statement("alter table `product` comment'商品表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}

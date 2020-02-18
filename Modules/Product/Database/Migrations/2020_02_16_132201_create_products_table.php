<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_category_id')->unsigned()->nullable();
            $table->integer('sort_order')->default(1)->nullable();
            $table->string('name', 256)->nullable();
            $table->string('url', 256)->nullable();
            $table->string('main_image', 256)->nullable();
            $table->integer('price')->unsigned()->nullable();
            $table->integer('action_price')->unsigned()->nullable();
            $table->integer('weight')->unsigned()->nullable();
            $table->tinyInteger('is_popular')->unsigned()->nullable();
            $table->tinyInteger('is_new')->unsigned()->nullable();
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
        Schema::dropIfExists('products');
    }
}

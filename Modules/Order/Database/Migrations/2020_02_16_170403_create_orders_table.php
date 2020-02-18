<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('org_id')->nullable();
            $table->integer('contact_id')->nullable();
            $table->integer('products_price')->nullable();
            $table->integer('delivery_price')->nullable();
            $table->tinyInteger('status')->nullable();
            //$table->tinyInteger('promo_id')->nullable(); // Лучше в отдельной таблице хранить, т.к. промо-акций может быть не одна а несколько
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
        Schema::dropIfExists('orders');
    }
}

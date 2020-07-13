<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('org_id')->nullable();
            $table->string('name', 64)->nullable();
            $table->string('action_key', 32)->nullable();

            $table->integer('product_count')->nullable();
            $table->integer('fixed_price')->nullable();
            $table->text('product_ids')->nullable();
            $table->integer('sum_min')->nullable();
            $table->integer('sum_max')->nullable();
            
            $table->text('gift_product_ids')->nullable();

            $table->string('discount', 32)->nullable();


            $table->string('image_sm', 255)->nullable();
            $table->string('image_md', 255)->nullable();
            $table->string('image_lg', 255)->nullable();


            $table->text('active_days')->nullable();
            $table->text('active_hours')->nullable();


            $table->dateTime('time_start')->nullable();
            $table->dateTime('time_end')->nullable();

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
        Schema::dropIfExists('actions');
    }
}

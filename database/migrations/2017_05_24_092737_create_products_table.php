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
            $table->increments('id');
            $table->string('name');
            $table->string('productCode')->unique();
            $table->string('price');
            $table->string('details');
            $table->string('offerPrice');
            $table->string('offerPercentage')->nullable();
            $table->string('status');
            $table->string('color');
            $table->string('size');
            $table->string('image');
            $table->integer('categoryId')->unsigned();
            $table->foreign('categoryId')->references('id')->on('menus')->onDelete('cascade');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('tag_number');
            $table->string('image');
            $table->string('name');
            $table->text('description');
            $table->unsignedInteger('units')->default(0);
            $table->integer('alert_quantity')->default(5);
            $table->bigInteger('category_id')->nullable();
            $table->double('price');
            $table->boolean('discount')->default(false);
            $table->string('discount_price')->default(0);
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

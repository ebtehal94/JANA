<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('country_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('stock')->default(0);
            $table->double('price',8,2);
            $table->double('discount',8,2)->default(0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('country_products');
    }
}

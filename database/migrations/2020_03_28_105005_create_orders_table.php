<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('code');
            $table->integer('customer_id')->nullable();
            $table->smallInteger('status')->nullable();
            $table->double('delivery_price',8,2)->nullable();
            $table->double('products_price',8,2)->nullable();
            $table->double('discount',8,2)->nullable();
            $table->double('payment_amount',8,2)->default(0);
            $table->double('payment_method',8,2)->nullable();
            $table->double('total_price',8,2)->default(0);
            $table->string('promo_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
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

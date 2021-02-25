<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->string('address')->nullable();
            $table->decimal('lat',25,20)->nullable();
            $table->decimal('lng',25,20)->nullable();
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
        Schema::dropIfExists('order_locations');
    }
}

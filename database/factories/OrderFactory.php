<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
  return [
    'code' => 'E3320C',
    'customer_id' => rand(12,21),
    'status' => rand(0,5),
    'delivery_price' => rand(10, 35),
    'products_price' => rand(100, 350),
    'discount' => rand(10, 35),
    'payment_amount' => rand(100, 300),
    'payment_method' => 1,
    'total_price' => rand(100, 350),
  ];
});

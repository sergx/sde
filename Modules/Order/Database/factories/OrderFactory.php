<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(Modules\Order\Entities\Order::class, function (Faker $faker) {
    return [
        'delivery_price' => 0,
        'status' => 0,
    ];
});

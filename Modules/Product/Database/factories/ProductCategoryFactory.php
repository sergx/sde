<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(Modules\Product\Entities\ProductCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName ." ". $faker->word
    ];
});

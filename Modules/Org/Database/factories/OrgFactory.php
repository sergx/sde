<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

//use Modules\Org\Entities\Org;
use Illuminate\Support\Str;

$factory->define(Modules\Org\Entities\Org::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->streetAddress,
        'work_time' => rand(8,11)."-".rand(22,23),
    ];
});

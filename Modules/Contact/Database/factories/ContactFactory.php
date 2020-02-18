<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(Modules\Contact\Entities\Contact::class, function (Faker $faker) {
    return [
        'name' => array_random([$faker->firstNameMale, $faker->firstNameFemale]),
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'address' =>$faker->streetAddress,
    ];
});

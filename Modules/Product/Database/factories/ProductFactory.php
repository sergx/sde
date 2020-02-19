<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use Modules\Product\Http\Controllers\ProductController;

$factory->define(Modules\Product\Entities\Product::class, function (Faker $faker) {
    $product = [
        'name' => ucfirst($faker->words(rand(2, 5), true)),
        'price' => rand(7,150) * 10,
        'main_image' => 'storage/main_image/noimage.jpg',
    ];
    if(rand(1,100) > 85){
        $product['action_price'] = $product['price'] * 0.9;
    }
    $product['weight'] = floor(($product['price'] * (rand(120, 200) / 100)) / 10) * 10 ;
    $product['url'] = (new ProductController)->getUrl($product['name']);
    return $product;
});

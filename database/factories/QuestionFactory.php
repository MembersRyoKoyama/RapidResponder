<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    $staffs = App\User::pluck('id')->all();
    $products = App\Product::pluck('id')->all();

    return [
        'name' => $faker->name,
        'mail' => $faker->unique()->safeEmail,
        'tel' => str_replace('-', '', $faker->phoneNumber),
        'products_id' => $products[random_int(0, count($products) - 1)],
        'content' => $faker->text(2000),
        'end' => random_int(1, 3),
        'staffs_id' => $staffs[random_int(0, count($staffs) - 1)],
        'date' => $faker->dateTime('now')->format('Y-m-d H:i:s'),
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'mail' => $faker->unique()->safeEmail,
        'tel' => str_replace('-', '', $faker->phoneNumber),
        'products_id' => null,
        'content' => $faker->text(2000),
        'end' => null,
        'staffs_id' => null,
        'date' => $faker->dateTime('now')->format('Y-m-d H:i:s'),
    ];
});

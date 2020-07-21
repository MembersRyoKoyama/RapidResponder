<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    $questions = App\Question::pluck('id')->all();
    $products = App\Product::pluck('id')->all();
    return [
        'questions_id' => $questions[random_int(0, count($questions) - 1)],
        'staffs_id' => $faker->unique()->safeEmail,
        'comment' => $faker->text(2000),
        'message' => $faker->text(4000),
        'date' => $faker->dateTime('now')->format('Y-m-d H:i:s'),
    ];
});

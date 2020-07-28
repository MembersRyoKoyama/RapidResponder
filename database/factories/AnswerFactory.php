<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Answer::class, function (Faker $faker) {
    $questions = App\Question::pluck('id')->all();
    $staffs = App\User::pluck('id')->all();
    $max = count($questions) - 1;
    return [
        'questions_id' => $questions[$max == 0 ? 0 : random_int(0, $max)],
        'staffs_id' => $staffs[random_int(0, count($staffs) - 1)],
        'comment' => $faker->text(2000),
        'message' => $faker->text(4000),
        'date' => $faker->dateTime('now')->format('Y-m-d H:i:s'),
    ];
});

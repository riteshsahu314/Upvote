<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Answer;
use App\Question;
use App\User;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'question_id' => function() {
            return factory('App\Question')->create()->id;
        },
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'body' => $faker->paragraph
    ];
});

$factory->state(Answer::class, 'from_existing_questions_and_users', function (Faker $faker) {
    return [
        'question_id' => function() {
            return Question::pluck('id')->random();
        },
        'user_id' => function() {
            return User::pluck('id')->random();
        },
        'body' => $faker->paragraph
    ];
});

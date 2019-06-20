<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Answer;
use App\Comment;
use App\Question;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'commentable_id' => function() {
            factory(Question::class)->create()->id;
        },
        'commentable_type' => 'App\Question',
        'body' => $faker->sentence
    ];
});

$factory->state(Comment::class, 'from_existing_questions_and_users', function (Faker $faker) {
    return [
        'user_id' => function() {
            return User::pluck('id')->random();
        },
        'commentable_id' => function() {
            return Question::pluck('id')->random();
        },
        'commentable_type' => 'App\Question',
        'body' => $faker->sentence
    ];
});

$factory->state(Comment::class, 'from_existing_answers_and_users', function (Faker $faker) {
    return [
        'user_id' => function() {
            return User::pluck('id')->random();
        },
        'commentable_id' => function() {
            return Answer::pluck('id')->random();
        },
        'commentable_type' => 'App\Answer',
        'body' => $faker->sentence
    ];
});

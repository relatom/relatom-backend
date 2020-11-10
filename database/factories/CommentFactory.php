<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'message' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        'event_id' => random_int(1, 5),
        'user_id' => 1,
    ];
});
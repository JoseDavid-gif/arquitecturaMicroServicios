<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    return [
        'book_id' => $faker->numberBetween(1, 50),
        'review' => $faker->paragraph(),
        'rating' => $faker->numberBetween(1, 5),
        'reviewer' => $faker->name,
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'book' => rtrim($faker->sentence("book".rand(5,10)), ".")
    ];
});

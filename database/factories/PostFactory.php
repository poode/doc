<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) use ($factory) {
    /**
     * @var int
     */
    static $id = 1;

    return [
        'id'      => $id++,
        'title'   => $faker->words(),
        'content' => $faker->sentences(),
    ];
});

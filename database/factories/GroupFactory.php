<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Group;
use App\User;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return User::inRandomOrder()->first();
        },
        'name' => $faker->words(2, true)
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Campaign;
use App\CampaignTemplate;
use App\CampaignStatus;
use App\User;
use Faker\Generator as Faker;

$factory->define(Campaign::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return User::inRandomOrder()->first()->id;
        },
        'name' => $faker->words(mt_rand(2, 5), true),
        'subject' => $faker->sentence,
        'from' => $faker->email,
        'template_id' => function() {
            return CampaignTemplate::inRandomOrder()->first()->id;
        },
        'status_id' => function() {
            return CampaignStatus::inRandomOrder()->first()->id;
        },
        'title' => $faker->words(mt_rand(2, 5), true),
        'text' => $faker->paragraph,
        'button_text' => $faker->words(mt_rand(2, 5), true),
        'button_color' => $faker->hexcolor,

    ];
});

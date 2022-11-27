<?php

/** @var Factory $factory */

use App\LogRelease;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(\App\Models\LogRelease::class, function (Faker $faker) {
    return [
        //
        'id' => rand(0, 10),
        'user_id' => $faker->unique()->ean8,
        'redmine_id' => $faker->phoneNumber,
        'version' => 'api/v3',
        'release_type' => 0,
        'environment' => 'development',
        'updated_at' => now(),
        'created_at' => now(),
    ];
});

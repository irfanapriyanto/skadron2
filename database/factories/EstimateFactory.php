<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Estimate;
use Faker\Generator as Faker;

$factory->define(Estimate::class, function (Faker $faker) {

    return [
        'lanud_from' => $faker->randomDigitNotNull,
        'lanud_to' => $faker->randomDigitNotNull,
        'est_time' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});

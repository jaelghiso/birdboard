<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Project;
use App\Models\User;
use Illuminate\Contrats\Auth\Authenticable;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->sentence(4),
        'notes' => 'Foobar notes',
        'owner_id' => function () {
            return factory(App\Models\User::class)->create();
        }
    ];
});

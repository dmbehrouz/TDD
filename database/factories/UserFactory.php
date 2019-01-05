<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class,function (Faker $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123456'),
        'access_id' => App\User::DEFAULT,
        'remember_token' => str_random(10),
        ];
    });

$factory->state(App\User::class , 'admin',[
    'access_id'=>App\User::ADMIN
]);

$factory->state(App\User::class, 'allField', function (Faker $faker) {
    return [
        'family' => $faker->lastName,
        'phone'=>$faker->phoneNumber,
        'photo'=>$faker->imageUrl(150,150)
    ];
});

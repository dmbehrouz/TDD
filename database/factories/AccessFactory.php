<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Access::class, function (Faker $faker) {
    return [
        'type'=>'Admin',
        'state'=>1
    ];
});

$factory->state(\App\Models\Access::class , 'default',[
    'type'=>'Default',
    'state'=>2
]);
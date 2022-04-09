<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Customer::class, function (Faker $faker) {
    $codeNumbers=['(237)','(251)','(212)','(258)','(256)'];
    $state=[array_rand([2368,range(1, 59),''])];
//    $numberComplement=[array_rand(range())];
    return [
        'name' => $faker->name,
        'phone' =>''
    ];
});

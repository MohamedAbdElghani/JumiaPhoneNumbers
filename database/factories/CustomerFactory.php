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
    $arrphones=[
            0 => ['code'=>'(237) ','state'=>array_rand([2368,'']),'phone'=>random_int(1000000, 99999999)],
            1 => ['code'=>'(251) ','state'=>array_rand([range(1, 59),'']),'phone'=>random_int(10000000, 99999999)],
            2 => ['code'=>'(212) ','state'=>array_rand([range(5, 9),'']),'phone'=>random_int(10000000, 99999999)],
            3 => ['code'=>'(258) ','state'=>array_rand([28,'']),'phone'=>random_int(1000000, 99999999)],
            4 => ['code'=>'(256) ','state'=>'','phone'=>random_int(100000000, 999999999)],
        ];

    $arrKey=array_rand($arrphones);
    $phone = implode("",$arrphones[$arrKey]);
    return [
        'name' => $faker->name,
        'phone' =>$phone
    ];
});

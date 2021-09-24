<?php

use App\User;
use Illuminate\Support\Str;
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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'student_id' => $faker->numberBetween($min = 10000, $max = 100000),
        'password' => md5('123456'),
        'semester_id' => $faker->numberBetween($min = 1, $max = 8),
        'dept_id' => $faker->numberBetween($min = 1, $max = 11),
        'batch_id' => $faker->numberBetween($min = 1, $max = 6),
        'gender' => $faker->randomElement( $array = array('Male', 'Female', 'Other')),
        'mobile' =>  $faker->phoneNumber,
        'status' => 1,
        'image' => '250x200.png',
        'remember_token' => null,
        'created_at' => $faker->date(),

    ];
});
$factory->define(App\Department::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement( $array = array('CSE', 'EEE', 'Architechture','IT','Physics','Chemistry','Civil','Mechanical','BBA','MBA')),
        'created_at' => $faker->date(),

    ];
});
$factory->define(App\Batch::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement( $array = array('4157','4158','4159','4150')),
        'created_at' => $faker->date(),

    ];
});
$factory->define(App\Semester::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement( $array = array('1st Semester','2nd Semester','3rd Semester','4th Semester','5th Semester','6th Semester','7th Semester','8th Semester')),
        'created_at' => $faker->date(),

    ];
});



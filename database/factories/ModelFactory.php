<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Article;
use App\User;


$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {

    $width= rand(500, 800);
    $height= rand(300, 600);
    return [
        'user_id' => User::all()->random()->id,
        'title' => $faker->title,
        'content' => $faker->paragraph,
        'image_path' => $faker->imageUrl($width, $height, 'cats'),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'article_id' => Article::all()->random()->id,
        'comment' => $faker->paragraph,
    ];
});

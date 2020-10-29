<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Corporativo;
use Faker\Generator as Faker;

$factory->define(Corporativo::class, function (Faker $faker) {
    return [
        'S_NombreCorto' => $faker->word(),
        'S_NombreCompleto' => $faker->company(),
        'S_LogoURL' => $faker->randomElement(['logo1.jpg', 'logo2.jpg', 'logo3.jpg']),
        'S_DBName' => 'DB' . $faker->word(), 
        'S_DBUsuario' => $faker->word(),
        'S_DBPassword' => $faker->password(),
        'S_SystemUrl' => $faker->url(),
        'S_Activo' => $faker->randomElement([ Corporativo::ACTIVO, Corporativo::INACTIVO]),
        'D_FechaIncorporacion' => $faker->dateTime()
    ];
});

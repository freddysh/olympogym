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
//$factory->define(App\User::class, function (Faker\Generator $faker) {
//    static $password;
//
//    return [
//        'name' => $faker->name,
//        'email' => $faker->unique()->safeEmail,
//        'password' => $password ?: $password = bcrypt('secret'),
//        'remember_token' => str_random(10),
//    ];
//});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'dni' => $faker->unique()->randomNumber(8),
        'name' => $faker->firstName(),
        'apellidos' => $faker->lastName(),
        'telefono' => $faker->phoneNumber(),
        'email' => $faker->safeEmail,
        'estado' => $faker->boolean(),
        'tipoPersonal' => str_random('Administrador','Ventas','Recepcion'),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Cliente::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'dni' => $faker->unique()->randomNumber(8),
        'nombres' => $faker->firstName(),
        'apellidos' => $faker->lastName(),
        'direccion' => $faker->address(),
        'telefono' => $faker->phoneNumber(),
        'email' => $faker->safeEmail,
        'estado' => $faker->boolean(),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Asistencia::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'fecha' => $faker->date(),
        'hora' => $faker->time(),
        'estado' => $faker->boolean(),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Promocion::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'titulo' => $faker->sentence(),
        'detalle' => $faker->paragraph(),
        'precio' => $faker->randomFloat(2,300,800),
        'tipoDuracion' => $faker->name,
        'duracion' => $faker->numberBetween(1,12),
        'estado' => $faker->boolean(),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Membresia::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'total' => $faker->randomFloat(2,300,800),
        'fechaInicio' => $faker->date(),
        'fechaFin' => $faker->date(),
        'estado' => $faker->boolean(),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Cuota::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'fechaCancelacion' => $faker->date(),
        'monto' => $faker->randomFloat(2,50,800),
        'fechaQCancelo' => $faker->date(),
        'estado' => $faker->boolean(),
        'remember_token' => str_random(10),
    ];
});
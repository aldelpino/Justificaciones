<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

  $factory->define(App\Justificacion::class, function (Faker $faker) {
    return [
      'nombreAlumno' => 'Alejandro Del Pino',
      'correoAlumno' => 'al.delpino@alumnos.duoc.cl',
      'fechaInicioJustificacion' =>  '05-07-2018',
      'fechaFinJustificacion' =>  '05-08-2018',
      'asignatura' => $faker->sentence,
      'tipoInasistencia' => $faker->sentence,
      'motivo' => $faker->sentence,
      'estado' => $faker->sentence,
      'comentario' => $faker->sentence,
      'correoCoordinador' => $faker->sentence,
      'correoDocente' => $faker->sentence,
      'motivoRechazo' => $faker->sentence,
      'comentarioRechazo' => $faker->sentence
    ];
});

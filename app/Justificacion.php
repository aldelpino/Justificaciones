<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Justificacion extends Model
{

      public $table = 'justificaciones';
      protected $fillable = [
        'fechaJustificacion',
        'asignatura',
        'motivo',
        'tipoInasistencia',
        'estado',
        'comentario',
        'nombreAlumno',
        'correoAlumno',
        'correoCoordinador',
        'correoDocente',
        'motivoRechazo',
        'comentarioRechazo',
      ];
}

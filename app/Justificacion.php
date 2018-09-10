<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Justificacion extends Model
{
    const CREATED_AT = 'fechaJustificacion';
    const UPDATED_AT = 'fechaActualizacion';
      public $table = 'justificaciones';
      protected $fillable = [
        'id',
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
      public $timestamps = false;
}

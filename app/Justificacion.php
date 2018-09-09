<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Justificacion extends Model
{
    const CREATED_AT = 'fechaJustificacion';
    const UPDATED_AT = 'fechaActualizacion';
      public $table = 'justifications';
      protected $fillable = [
        'id_dato',
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

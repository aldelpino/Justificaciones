<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        // datos alumno
        'id_dato', 'RUT_ALU', 'COD_SECCION', 'NOM_ASIG',
        'NOMBRE_ALUM', 'APEP_ALUM', 'APEM_ALUM', 'CORREO_ALUM',
        'contrasena_alum', 'recovery_alum', 'CELULAR',

        // datos carrera
        'cod_carrera', 'CARRERA', 'JORNADA',

        // datos docente
        'rut_doc', 'NOMBRE_DOC', 'APEP_DOC', 'CORREO_DOC',

        // datos coordinador
        'NOMBRE_COR', 'APEP_COR', 'APEM_COR', 'CORREO_COR', // 'contrasena_cor', 'recovery_cor'
    ];

    protected $table = 'datos_semestre';
}

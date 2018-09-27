<?php

namespace App\Mail\Justification\Rejected;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ToTeacher extends Mailable
{
    use Queueable, SerializesModels;

    public $justification;
    public $alumno;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($justification, $alumno)
    {
        $this->justification = $justification;
        $this->alumno = $alumno;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Resolución de justificación')
            ->markdown('correos.justificaciones.rechazadas.profesor')
            ->with([
                'fechaJustificacion' => $this->justification->FEC_SOL,
                'rutAlumno' => $this->alumno->rut_alu,
                'nombreAlumno' => $this->alumno->NOMBRE_ALUM.' '.$this->alumno->APEP_ALUM,
                'carreraAlumno' => $this->alumno->carrera,
                'asignatura' => $this->justification->ASIGNATURA,
                'nombreCoordinador' => $this->alumno->NOMBRE_COR.' '.$this->alumno->APEP_COR,
                'resolucion' => $this->justification->COMENTARIO_REC,
            ]);
    }
}

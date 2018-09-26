<?php

namespace App\Mail\Justification\Approved;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ToStudent extends Mailable
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
            ->markdown('correos.justificaciones.aprobadas.alumno')
            ->with([
                'folio' => $this->justification->nfolio,
                'nombreProfesor' => $this->alumno->NOMBRE_DOC.' '.$this->alumno->APEP_DOC,
                'rutAlumno' => $this->alumno->rut_alu,
                'nombreAlumno' => $this->alumno->NOMBRE_ALUM.' '.$this->alumno->APEP_ALUM,
                'asignatura' => $this->justification->ASIGNATURA,
                'resolucion' => $this->justification->COMENTARIO_REC,
                'fechaJustificacion' => $this->justification->FEC_SOL,
            ]);
    }
}

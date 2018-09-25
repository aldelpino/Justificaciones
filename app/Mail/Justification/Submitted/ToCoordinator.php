<?php

namespace App\Mail\Justification\Submitted;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Requests\ContactFormRequest;

class ToCoordinator extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $adjuntos;
    public $resumenAsignaturas;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ContactFormRequest $message, $adjuntos, $resumenAsignaturas)
    {
        $this->message = $message;
        $this->adjuntos = $adjuntos;
        $this->resumenAsignaturas = $resumenAsignaturas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Justificación ingresada')
            ->markdown('correos.justificaciones.creadas.coordinador')
            ->with([
                'nombreAlumno' => $this->message->nombre_alum.' '.$this->message->apep_alum.' '.$this->message->apem_alum,
                'nombreProfe' => $this->message->nombreDocente,
                'nombreCoordinador' => $this->message->nombreCoordinador,
                'folio' => $this->message->folio,
                'comentario' => $this->message->comentario,
                'resumenAsignaturas' => $this->resumenAsignaturas,
            ]);
    }
}

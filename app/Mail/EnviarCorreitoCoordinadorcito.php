<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Requests\ContactFormRequest;
use Log;

class EnviarCorreitoCoordinadorcito extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(contactFormRequest $message, $adjuntos)
    {
        $this->message = $message;
        $this->adjuntos = $adjuntos;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::Debug($this->adjuntos);
        $correito = $this->from('justificaciones@duoc.cl')
                        ->subject('Creación de Justificación - Coordinador')
                    // ->attach('storage/2018/09/201809AWxHDge7.png')
                    // ->attach('storage/2018/09/201809nuQL0sbw.png')
                    ->view('correos.coordinador')
                    ->with([
                        'nombreAlumno' => $this->message->nombre_alum.' '.$this->message->apep_alum.' '.$this->message->apem_alum,
                        'nombreProfe' => $this->message->nombreDocente,
                        'nombreCoordinador' => $this->message->nombreCoordinador,
                    ]);
        foreach($this->adjuntos as $filePath){
            Log::Debug($filePath->url);
            Log::Debug('###################################################################');
            $correito->attach('storage/'.$filePath->url);
        }
        return $correito;
    }
}

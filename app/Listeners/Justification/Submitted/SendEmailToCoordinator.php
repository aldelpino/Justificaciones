<?php

namespace App\Listeners\Justification\Submitted;

use App\Events\Justification\Submitted as JustificationSubmitted;
use App\Mail\Justification\Submitted\ToCoordinator;
use Mail;
use DB;

class SendEmailToCoordinator
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(JustificationSubmitted $event)
    {
        $alumno = DB::table('datos_semestre')
            ->where('CORREO_ALUM', $event->studentEmail)
            ->first(['rut_alu', 'carrera']);
        Mail::to($event->coordinatorEmail)
            ->send(new ToCoordinator($event->message, $event->adjuntos, $event->resumenAsignaturas, $alumno));
    }
}

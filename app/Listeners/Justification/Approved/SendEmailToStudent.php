<?php

namespace App\Listeners\Justification\Approved;

use App\Events\Justification\Approved as JustificationApproved;
use App\Mail\Justification\Approved\ToStudent as JustificationApprovedEmail;
use Mail;
use DB;

class SendEmailToStudent
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
    public function handle(JustificationApproved $event)
    {
        $alumno = DB::table('datos_semestre')
            ->where('CORREO_ALUM', $event->studentEmail)
            ->first(['rut_alu', 'carrera', 'NOMBRE_ALUM', 'APEP_ALUM', 'NOMBRE_DOC', 'APEP_DOC']);
        Mail::to($event->studentEmail)
            ->send(new JustificationApprovedEmail(
                $event->justification,
                $alumno
            ));
    }
}

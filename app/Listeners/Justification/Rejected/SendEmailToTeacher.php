<?php

namespace App\Listeners\Justification\Rejected;

use App\Events\Justification\Rejected as JustificationRejected;
use App\Mail\Justification\Rejected\ToTeacher as JustificationRejectedEmail;
use Mail;
use DB;

class SendEmailToTeacher
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
    public function handle(JustificationRejected $event)
    {
        $alumno = DB::table('datos_semestre')
            ->where('CORREO_ALUM', $event->studentEmail)
            ->first(['rut_alu', 'carrera', 'NOMBRE_ALUM', 'APEP_ALUM', 'NOMBRE_DOC', 'APEP_DOC', 'NOMBRE_COR', 'APEP_COR']);
        Mail::to($event->teacherEmail)
            ->send(new JustificationRejectedEmail($event->justification, $alumno));
    }
}

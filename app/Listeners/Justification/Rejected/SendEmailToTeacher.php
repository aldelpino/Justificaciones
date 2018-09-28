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
        $justifications = DB::table('justifications')->where('nfolio', $event->justification->NFOLIO)->get();
        $filteredTeacherEmails = $justifications->unique('CORREO_DOC')->pluck('CORREO_DOC');
        $alumno = DB::table('datos_semestre')
            ->where('CORREO_ALUM', $event->justification->CORREO_ALUM)
            ->where('NOM_ASIG', $event->justification->ASIGNATURA)
            ->get();

        foreach ($filteredTeacherEmails as $email) {
            Mail::to($email)->send(new JustificationRejectedEmail(
                $event->justification,
                $alumno[0]
            ));
        }
    }
}

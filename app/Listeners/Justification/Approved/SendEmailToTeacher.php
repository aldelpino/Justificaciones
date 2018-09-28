<?php

namespace App\Listeners\Justification\Approved;

use App\Events\Justification\Approved as JustificationApproved;
use App\Mail\Justification\Approved\ToTeacher as JustificationApprovedEmail;
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
    public function handle(JustificationApproved $event)
    {
        dd($event->justification->NFOLIO);
        $justifications = DB::table('justifications')->where('NFOLIO', '=', $event->justification->NFOLIO)->get();
        // dd($justifications, $event->justification);
        $filteredTeacherEmails = $justifications->unique('CORREO_DOC')->pluck('CORREO_DOC');
        dd($filteredTeacherEmails);
        $alumno = DB::table('datos_semestre')
            ->where('CORREO_ALUM', $event->justification->CORREO_ALUM)
            ->where('NOM_ASIG', $event->justification->ASIGNATURA)
            ->get();

        dd($alumno);
        foreach ($filteredTeacherEmails as $email) {
            Mail::to($email)->send(new JustificationApprovedEmail(
                $event->justification,
                $alumno[0]
            ));
        }
    }
}

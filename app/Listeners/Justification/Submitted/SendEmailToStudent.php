<?php

namespace App\Listeners\Justification\Submitted;

use App\Events\Justification\Submitted;
use App\Mail\Justification\Submitted\ToStudent as JustificationSubmittedToStudent;
use Mail;

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
    public function handle(Submitted $event)
    {
        Mail::to($event->studentEmail)
            ->send(new JustificationSubmittedToStudent($event->message, $event->adjuntos, $event->resumenAsignaturas));
    }
}

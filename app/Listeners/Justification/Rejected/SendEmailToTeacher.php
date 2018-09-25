<?php

namespace App\Listeners\Justification\Rejected;

use App\Events\Justification\Rejected as JustificationRejected;
use App\Mail\Justification\Rejected\ToTeacher as JustificationApprovedEmail;
use Mail;

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
        Mail::to($event->teacherEmail)->send(new JustificationApprovedEmail());
    }
}

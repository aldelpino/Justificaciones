<?php

namespace App\Listeners\Justification\Submitted;

use App\Events\Justification\Submitted;
use App\Mail\Justification\Submitted\ToCoordinator as JustificationSubmittedToCoordinator;
use Mail;

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
    public function handle(Submitted $event)
    {
        Mail::to($event->coordinatorEmail)
            ->send(new JustificationSubmittedToCoordinator($event->message, $event->adjuntos, $event->resumenAsignaturas));
    }
}

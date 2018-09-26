<?php

namespace App\Events\Justification;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Submitted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $studentEmail;
    public $coordinatorEmail;
    public $message;
    public $adjuntos;
    public $resumenAsignaturas;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($studentEmail, $coordinatorEmail, $message, $adjuntos, $resumenAsignaturas)
    {
        $this->studentEmail = $studentEmail;
        $this->coordinatorEmail = $coordinatorEmail;
        $this->message = $message;
        $this->adjuntos = $adjuntos;
        $this->resumenAsignaturas = $resumenAsignaturas;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

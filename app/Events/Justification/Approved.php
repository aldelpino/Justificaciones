<?php

namespace App\Events\Justification;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Approved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $studentEmail;
    public $teacherEmail;
    public $justification;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($studentEmail, $teacherEmail, $justification)
    {
        $this->studentEmail = $studentEmail;
        $this->teacherEmail = $teacherEmail;
        $this->justification = $justification;
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

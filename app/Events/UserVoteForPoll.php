<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Poll;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class UserVoteForPoll implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $poll;
    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Poll $poll)
    {
        $this->poll = $poll;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('poll.'.$this->poll->id);
    }

    public function broadcastWith()
    {
        return ['button_one_percentage' => $this->poll->button_one_percentage, 
                'button_two_percentage' => $this->poll->button_two_percentage,
                'button_one' => $this->poll->button_one,
                'button_two' => $this->poll->button_two,
                'username'   => auth()->user()->name,
                'opinion'   =>  auth()->user()->opinion($this->poll)
            ];
    }
}

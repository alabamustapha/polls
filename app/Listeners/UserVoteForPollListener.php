<?php

namespace App\Listeners;

use App\Events\UserVoteForPoll;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserVoteForPollListener
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
     * @param  UserVoteForPoll  $event
     * @return void
     */
    public function handle(UserVoteForPoll $event)
    {
        //
    }
}

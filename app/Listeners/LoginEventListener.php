<?php

namespace App\Listeners;

use App\Events\LoginEventHandler;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginEventListener
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
     * @param  LoginEventHandler  $event
     * @return void
     */
    public function handle(LoginEventHandler $event)
    {
        $event->last_login=Carbon::now();
        $event->save();
    }
}

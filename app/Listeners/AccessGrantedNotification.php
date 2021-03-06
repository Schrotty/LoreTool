<?php

namespace App\Listeners;

use App\Events\AccessGrantedEvent;
use App\Events\NewsPublished;
use App\Notifications\AccessGranted;
use App\Notifications\NewsPublish;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AccessGrantedNotification
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
     * @param  NewsPublished  $event
     * @return void
     */
    public function handle(AccessGrantedEvent $event)
    {
        //abort(418, "'I'am a teapot");
        foreach($event->subscriber as $_id)
        {
            User::find($_id)->notify(new AccessGranted($event->item));
        }
    }
}

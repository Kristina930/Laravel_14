<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateLastLoginAtListener
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
     * @param object $event
     * @return void
     */
    //обрабатывает все события или несколько событий (смс отправка), связка 2
    //instanceof принадлежит к модели пользователь

    public function handle(object $event)
    {
        if(isset($event->user) && $event->user instanceof User) {
            $event->user->last_login_at = now('Europe/Moscow');
            $event->user->save();
        }
    }
}

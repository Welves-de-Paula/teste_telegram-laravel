<?php

namespace App\Listeners;

use App\Events\TelegramNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\TestTelegramNotification;

class SendTestTelegramNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  TelegramNotification  $event
     * @return void
     */
    public function handle(TelegramNotification $event)
    {
        $event->user->notify(new TestTelegramNotification($event->message));
    }
}

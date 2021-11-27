<?php

namespace Softwarescares\Safaricomdaraja\app\Listeners;

use Softwarescares\Safaricomdaraja\app\Notification\TransactionFailedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Softwarescares\Safaricomdaraja\app\Events\TransactionStatusNotificationEvent;

class TransactionStatusNotificationEventlistener
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
     * @param  object  $event
     * @return void
     */
    public function handle(TransactionStatusNotificationEvent $event)
    {
        # dd($event->error["user"]);
        Log::info("EventListener");
        Log::info(json_encode($event));

     Notification::send($event->error["user"], new TransactionFailedNotification($event));
    }
}

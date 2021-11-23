<?php

namespace Softwarescares\Safaricomdaraja\app\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Softwarescares\Safaricomdaraja\app\Events\MpesaExpressTransactionAcceptedEvent;
use Softwarescares\Safaricomdaraja\app\Notification\MpesaExpressTransactionAcceptedNotification;

class MpesaExpressTransactionAcceptedEventListener
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
    public function handle(MpesaExpressTransactionAcceptedEvent $event)
    {
        Log::info("MpesaExpressTransactionAcceptedEvent  Listener");
        Log::info(json_encode($event));

     Notification::send($event->success["user"], new MpesaExpressTransactionAcceptedNotification($event));
    }
}

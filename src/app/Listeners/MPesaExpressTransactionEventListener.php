<?php

namespace Softwarescares\Safaricomdaraja\app\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Softwarescares\Safaricomdaraja\app\Events\MPesaExpressTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Models\MpesaExpressTransaction;
use Softwarescares\Safaricomdaraja\app\Services\MPesaExpressService;

class MPesaExpressTransactionEventListener
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
    public function handle(MPesaExpressTransactionEvent $event)
    {
        //-- Fire Notification

        //-- Store the transaction in database
        MpesaExpressTransaction::create(
            ["body" => serialize($event)]
        );

    }
}

<?php

namespace Softwarescares\Safaricomdaraja\app\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Softwarescares\Safaricomdaraja\app\Events\TransactionEvent;
use Softwarescares\Safaricomdaraja\app\Services\MPesaExpressService;

class TransactionEventListener
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
    public function handle(TransactionEvent $event)
    {
        //-- Fire Notification

        //-- Store the transaction in database
        DB::insert(
            ["body" => serialize($event)]
        );

    }
}

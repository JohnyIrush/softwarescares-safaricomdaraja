<?php

namespace Softwarescares\Safaricomdaraja\app\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Softwarescares\Safaricomdaraja\app\Events\BusinessToCustomerTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Events\TransactionReversalEvent;
use Softwarescares\Safaricomdaraja\app\Models\BusinessToCustomerTransaction;
use Softwarescares\Safaricomdaraja\app\Models\TransactionReversal;

class TransactionReversalEventListener
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
    public function handle(TransactionReversalEvent $event)
    {
        TransactionReversal::create(
            [

            ]
            );
    }
}

<?php

namespace Softwarescares\Safaricomdaraja\app\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Softwarescares\Safaricomdaraja\app\Events\CustomerToBusinessTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Models\CustomerToBusinessTransaction;

class CustomerToBusinessTransactionEventListener
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
    public function handle(CustomerToBusinessTransactionEvent $event)
    {
        CustomerToBusinessTransaction::create(
            $event
        );
    }
}

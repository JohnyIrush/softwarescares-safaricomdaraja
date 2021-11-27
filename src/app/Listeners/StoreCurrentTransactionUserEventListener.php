<?php

namespace Softwarescares\Safaricomdaraja\app\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Softwarescares\Safaricomdaraja\app\Models\CurrentTransactionUser;

class StoreCurrentTransactionUserEventListener
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
    public function handle($event)
    {
        CurrentTransactionUser::updateOrCreate(
            ['id' =>  1],
            ['current_transaction_user_id' => $event->user_id]
        );
    }
}

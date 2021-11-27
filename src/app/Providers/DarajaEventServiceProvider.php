<?php

namespace Softwarescares\Safaricomdaraja\app\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use Softwarescares\Safaricomdaraja\app\Events\BusinessToCustomerTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Events\CustomerToBusinessTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Events\TransactionNotificationEvent;
use Softwarescares\Safaricomdaraja\app\Events\MPesaExpressTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Events\StoreCurrentTransactionUserEvent;
use Softwarescares\Safaricomdaraja\app\Events\TransactionReversalEvent;
use Softwarescares\Safaricomdaraja\app\Events\TransactionStatusNotificationEvent;
use Softwarescares\Safaricomdaraja\app\Events\TransactionUpdateReversalEvent;
use Softwarescares\Safaricomdaraja\app\Listeners\BusinessToCustomerTransactionEventListener;
use Softwarescares\Safaricomdaraja\app\Listeners\CustomerToBusinessTransactionEventListener;
use Softwarescares\Safaricomdaraja\app\Listeners\TransactionNotificationEventListener;
use Softwarescares\Safaricomdaraja\app\Listeners\MPesaExpressTransactionEventListener;
use Softwarescares\Safaricomdaraja\app\Listeners\StoreCurrentTransactionUserEventListener;
use Softwarescares\Safaricomdaraja\app\Listeners\TransactionReversalEventListener;
use Softwarescares\Safaricomdaraja\app\Listeners\TransactionStatusNotificationEventlistener;
use Softwarescares\Safaricomdaraja\app\Listeners\TransactionUpdateReversalEventListener;

class DarajaEventServiceProvider extends ServiceProvider
{
    /**
    * The event listener mappings for the application.
    *
    * @var array
    */
    protected $listen = [
        MPesaExpressTransactionEvent::class => [
             MPesaExpressTransactionEventListener::class,
            ],
        CustomerToBusinessTransactionEvent::class => [
         CustomerToBusinessTransactionEventListener::class,
        ],
        BusinessToCustomerTransactionEvent::class => [
             BusinessToCustomerTransactionEventListener::class,
            ],
   
        TransactionStatusNotificationEvent::class => [
         TransactionStatusNotificationEventlistener::class,
        ],
        TransactionNotificationEvent::class => [
            TransactionNotificationEventListener::class,
        ],
        TransactionReversalEvent::class => [
            TransactionReversalEventListener::class,
        ],

        TransactionUpdateReversalEvent::class => [
            TransactionUpdateReversalEventListener::class,
        ],
        StoreCurrentTransactionUserEvent::class => [
            StoreCurrentTransactionUserEventListener::class,
        ],
        ];
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        # dd("Fired !!!!!!!!!!!!!!!");
    }
}

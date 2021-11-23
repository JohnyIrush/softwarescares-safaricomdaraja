<?php

namespace Softwarescares\Safaricomdaraja\app\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use Softwarescares\Safaricomdaraja\app\Events\BusinessToCustomerTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Events\CustomerToBusinessTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Events\MpesaExpressTransactionAcceptedEvent;
use Softwarescares\Safaricomdaraja\app\Events\MPesaExpressTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Events\TransactionStatusNotificationEvent;
use Softwarescares\Safaricomdaraja\app\Listeners\BusinessToCustomerTransactionEventListener;
use Softwarescares\Safaricomdaraja\app\Listeners\CustomerToBusinessTransactionEventListener;
use Softwarescares\Safaricomdaraja\app\Listeners\MpesaExpressTransactionAcceptedEventListener;
use Softwarescares\Safaricomdaraja\app\Listeners\MPesaExpressTransactionEventListener;
use Softwarescares\Safaricomdaraja\app\Listeners\TransactionStatusNotificationEventlistener;

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
        MpesaExpressTransactionAcceptedEvent::class => [
        MpesaExpressTransactionAcceptedEventListener::class,
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

<?php

namespace Softwarescares\Safaricomdaraja\app\Providers;

use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\AccountBalanceController;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\BusinessToCustomerController;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\CustomerToBusinessController;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\MpesaExpressController;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\TransactionReversalController;
use Illuminate\Support\ServiceProvider;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Events\MPesaExpressTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Listeners\MPesaExpressTransactionEventListener;
use Softwarescares\Safaricomdaraja\app\Events\CustomerToBusinessTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Listeners\CustomerToBusinessTransactionEventListener;
use Softwarescares\Safaricomdaraja\app\Events\BusinessToCustomeTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Events\TransactionStatusNotificationEvent;
use Softwarescares\Safaricomdaraja\app\Listeners\BusinessToCustomeTransactionEventListener;
use Softwarescares\Safaricomdaraja\app\Listeners\TransactionStatusNotificationEventlistener;
use Softwarescares\Safaricomdaraja\app\Services\AccountBalanceService;
use Softwarescares\Safaricomdaraja\app\Services\BusinessToCustomerservice;
use Softwarescares\Safaricomdaraja\app\Services\CustomerToBusinessService;
use Softwarescares\Safaricomdaraja\app\Services\MPesaExpressService;
use Softwarescares\Safaricomdaraja\app\Services\TransactionReversalService;

class DarajaTransactionProvider extends ServiceProvider
{



    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(AccountBalanceController::class)
             ->needs(TransactionInterface::class)
             ->give(AccountBalanceService::class);

        $this->app->when(BusinessToCustomerController::class)
             ->needs(TransactionInterface::class)
             ->give(BusinessToCustomerservice::class);

        $this->app->when(CustomerToBusinessController::class)
             ->needs(TransactionInterface::class)
             ->give(CustomerToBusinessService::class);

        $this->app->when(MpesaExpressController::class)
             ->needs(TransactionInterface::class)
             ->give(MPesaExpressService::class);

        $this->app->when(TransactionReversalController::class)
             ->needs(TransactionInterface::class)
             ->give(TransactionReversalService::class);

        $this->app->when(TransactionStatusController::class)
             ->needs(TransactionInterface::class)
             ->give(TransactionStatusService::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}

<?php

namespace Softwarescares\Safaricomdaraja\app\Providers;

use App\Http\Controllers\AccountBalanceController;
use App\Http\Controllers\BusinessToCustomerController;
use App\Http\Controllers\CustomerToBusinessController;
use App\Http\Controllers\MpesaExpressController;
use App\Http\Controllers\TransactionReversalController;
use Illuminate\Support\ServiceProvider;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
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
        //
    }
}

<?php

namespace Softwarescares\Safaricomdaraja\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Softwarescares\Safaricomdaraja\app\Models\BusinessToCustomerTransaction;
use Softwarescares\Safaricomdaraja\app\Models\CustomerToBusinessTransaction;
use Softwarescares\Safaricomdaraja\app\Models\MpesaExpressTransaction;

class DarajaController extends Controller
{
    public function transactions()
    {
        return view("safaricomdaraja::components.plugins.all-transactions")->with(
            [
                'mpesaexpresstransactions' => MpesaExpressTransaction::all(),
                'c2btransactions' => CustomerToBusinessTransaction::all(),
                'b2ctransactions' => BusinessToCustomerTransaction::all()
            ]
        );

    }
}

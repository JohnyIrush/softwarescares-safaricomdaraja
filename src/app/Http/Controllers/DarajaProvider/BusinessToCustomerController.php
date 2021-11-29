<?php

namespace Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider;

use App\Models\User;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Events\StoreCurrentTransactionUserEvent;
use Softwarescares\Safaricomdaraja\app\Models\BusinessToCustomerTransaction;
use Softwarescares\Safaricomdaraja\app\Models\CurrentTransactionUser;
use Softwarescares\Safaricomdaraja\app\Services\BusinessToCustomerservice;

class BusinessToCustomerController extends Controller
{
    private $transactionService;

    public function __construct(TransactionInterface $transactionService)
    {
        $this->middleware("web");
        $this->transactionService = $transactionService;
    }

    public function create()
    {
        return view("safaricomdaraja::components.forms.business-to-customer-form");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function businessToCustomer(Request $request)
    {
        event(new StoreCurrentTransactionUserEvent(Auth::user()->id)); // persists this user even after the callback from safaricom
        return $this->transactionService->transaction($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function result(Request $request)
    {
        Log::info("B2C Result ENDPOINT HIT!");
        Auth::login(User::find(CurrentTransactionUser::find(1)->current_transaction_user_id));
        $this->transactionService->result($request->all(), []);
    }


    public function queueTimeOutURL(Request $request, BusinessToCustomerservice $service)
    {
        Log::info("B2C timeout HIT!");
        Auth::login(User::find(CurrentTransactionUser::find(1)->current_transaction_user_id));
        $service->queueTimeout($request->all());
    }

    public function transactions()
    {
        return view("safaricomdaraja::components.plugins.business-to-customer-transactions")->with([
            "b2ctransactions" => BusinessToCustomerTransaction::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

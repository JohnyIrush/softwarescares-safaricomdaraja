<?php

namespace Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider;

use Softwarescares\Safaricomdaraja\app\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Softwarescares\Safaricomdaraja\app\Events\StoreCurrentTransactionUserEvent;
use Softwarescares\Safaricomdaraja\app\Models\CustomerToBusinessTransaction;
use Softwarescares\Safaricomdaraja\app\Services\CustomerToBusinessService;

class CustomerToBusinessController extends Controller
{
    private $transactionService;

    public function __construct(CustomerToBusinessService $transactionService)
    {
        $this->middleware("web");
        $this->transactionService = $transactionService;
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
    public function create()
    {
        return view("safaricomdaraja::components.forms.customer-to-business-form");
    }

    //-- Initiate c2B Transaction request

    public function customerToBusiness(Request $request)
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
    public function validation(Request $request)
    {
        $this->transactionService->validation($request->all(),[]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirmation(Request $request)
    {
        $this->transactionService->confirmation($request->all());
    }


    public function transactions()
    {
        return view("safaricomdaraja::components.plugins.customer-to-business-transactions")->with([
            "c2btransactions" => CustomerToBusinessTransaction::all()
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

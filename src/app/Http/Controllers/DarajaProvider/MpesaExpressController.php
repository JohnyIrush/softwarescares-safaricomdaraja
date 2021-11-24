<?php

namespace Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider;

use Softwarescares\Safaricomdaraja\app\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;

class MpesaExpressController extends Controller
{

    protected $transactionService;

    public function __construct(TransactionInterface $transactionService)
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
        $notifications = Auth::user()->unreadNotifications;
        return view("safaricomdaraja::components.forms.mpesa-express-form", compact('notifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function mpesaExpress(Request $request)
    {
        return response()->json($this->transactionService->transaction($request->all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function result(Request $request)
    {
        $this->transactionService->result($request->all());
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

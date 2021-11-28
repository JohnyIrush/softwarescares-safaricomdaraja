@extends('safaricomdaraja::layouts.app')

@section('content')
<!--Table-->
<div class="container">
    <div class="card table-responsive">
        <table class="table">
            <thead>
                <tr class="row100 head">
                    <th class="cell100 column1">OrderId</th>
                    <!--<th class="cell100 column2">MerchantRequestID</th>-->
                    <!--<th class="cell100 column3">CheckoutRequestID</th>-->
                    <!--<th class="cell100 column4">ResultCode</th>-->
                    <th class="cell100 column2">ResultDesc</th>
                    <th class="cell100 column3">Amount</th>
                    <th class="cell100 column4">MpesaReceiptNumber</th>
                    <th class="cell100 column5">TransactionDate</th>
                    <th class="cell100 column6">PhoneNumber</th>
                    <th class="cell100 column7">Actions</th>
                    <th class="">Reversal</th>
                </tr>
            </thead>
            <tbody>

            @foreach ($mpesaexpresstransactions as $transaction)
                
                <tr class="row100 body">
                    <td class="cell100 column1">{{ $transaction->order_id}}</td>
                    <!--<td class="cell100 column2">{{-- $transaction->MerchantRequestID --}}</td>
                    <td class="cell100 column3">{{-- $transaction->CheckoutRequestID --}}</td>
                    <td class="cell100 column4">{{-- $transaction->ResultCode --}}</td>-->
                    <td class="cell100 column2">{{ $transaction->ResultDesc}}</td>
                    <td class="cell100 column3">{{ $transaction->Amount}}</td>
                    <td class="cell100 column4">{{ $transaction->MpesaReceiptNumber}}</td>
                    <td class="cell100 column5">{{  \Carbon\Carbon::parse($transaction->TransactionDate)->format('d/m/Y')}}</td>
                    <td class="cell100 column6">{{ $transaction->PhoneNumber}}</td>
                    <td class="cell100 column7">
                    <div class="dropdown show">
                      <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Transaction Actions
                      </a>
                    
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <a class="dropdown-item" href="#">Check Status</a>
                      </div>
                    </div>
                    </td>
                    <td id="reverse-state" class="">
                        @if ($transaction->ResultCode == 0 /* && $transaction->Reversed == "false"*/)
                        <form id="transaction-reversal-form" class="px-4 py-3">
                          @csrf
                            <input type="hidden" name="transactionid" class="form-control" id="transactionid" placeholder="Transaction Id" value="{{ $transaction->MpesaReceiptNumber}}">
                            <input type="hidden" name="transaction_type" class="form-control" id="transaction_type"value="c2b-express">
                            <input type="hidden" name="transaction_id" class="form-control" id="transaction_id"value="{{ $transaction->id}} }}">
                            <input type="hidden" name="Amount" class="form-control" id="Amount" placeholder="Amount" value="{{ $transaction->Amount}}">
                          <button type="submit" class="btn btn-primary">Reverse</button>
                        </form>  
                        @else
                         <p class="text-success">Reversed</p>
                        @endif
                      </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--Table-->
@endsection
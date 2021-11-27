@extends('safaricomdaraja::layouts.app')

@section('content')
<!--Table-->
<div class="container">
    <div class="card table-responsive">
        <table class="table">
            <thead>
                <tr class=" head">
                    <th class="">OrderId</th>
                    <!--<th class="">ransactionType</th>-->
                    <th class="">TransID</th>
                    <th class="">TransTime</th>
                    <th class="">TransAmount</th>
                    <th class="">BusinessShortCode</th>
                    <!--<th class="">BillRefNumber</th>-->
                    <th class="">OrgAccountBalance</th>
                    <th class="">InvoiceNumber</th>
                    <th class="">ThirdPartyTransID</th>
                    <!--<th class="1">MSISDN</th>-->
                    <th class="">Name</th>
                    <th class="">Reversal</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($c2btransactions as $transaction)
                <tr class="">
                    <td class="">{{ $transaction->order_id}}</td>
                    <!--<td class="cell100 column2">{{-- $transaction->ransactionType --}}</td>-->
                    <td class="">{{ $transaction->TransID}}</td>
                    <td class="">{{ $transaction->TransTime}}</td>
                    <td class="">{{ $transaction->TransAmount}}</td>
                    <td class="">{{ $transaction->BusinessShortCode}}</td>
                    <!--<td class="">{{-- $transaction->BillRefNumber --}}</td>-->
                    <td class="">{{  $transaction->OrgAccountBalance}}</td>
                    <td class="">{{ $transaction->InvoiceNumber}}</td>
                    <td class="">{{ $transaction->ThirdPartyTransID}}</td>
                    <!--<td class="1">{{-- $transaction->MSISDN --}}</td>-->
                    <td class="">{{ $transaction->FirstName . " " . $transaction->MiddleName . " " . $transaction->LastName}}</td>
                    <td id="reverse-state" class="">
                      @if ($transaction->ResultCode == 0 && $transaction->Reversed == "false" )
                      <form id="transaction-reversal-form" class="px-4 py-3">
                        @csrf
                          <input type="hidden" name="transactionid" class="form-control" id="transactionid" placeholder="Transaction Id" value="{{ $transaction->TransID}}">
                          <input type="hidden" name="transaction_type" class="form-control" id="transaction_type"value="c2b">
                          <input type="hidden" name="transaction_id" class="form-control" id="transaction_id"value="{{ $transaction->id}} }}">
                          <input type="hidden" name="Amount" class="form-control" id="Amount" placeholder="Amount" value="{{ $transaction->TransAmount}}">
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
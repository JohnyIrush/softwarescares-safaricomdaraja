@extends('safaricomdaraja::layouts.app')

@section('content')
<!--Table-->
<div class="container">
  <div class="card table-responsive">
    <table class="table">
        <thead>
          <tr class="row100 head">
              <th class="cell100 column1">OrderId</th>
              <!--<th class="cell100 column2">TransactionType</th>
              <th class="cell100 column3">B2CWorkingAccountAvailableFunds</th>
              <th class="cell100 column4">ResultCode</th> -->
              <th class="cell100 column5">ResultDesc</th>
              <!--<th class="cell100 column6">OriginatorConversationID</th>
              <th class="cell100 column7">ConversationID</th>-->
              <th class="cell100 column8">TransactionID</th>
              <th class="cell100 column9">TransactionAmount</th>
              <th class="cell100 column10">TransactionReceipt</th>
              <!--<th class="cell100 column11">B2CRecipientIsRegisteredCustomer</th>
              <th class="cell100 column12">B2CChargesPaidAccountAvailableFunds</th>-->
              <th class="cell100 column13">ReceiverPartyPublicName</th>
              <th class="cell100 column14">TransactionCompletedDateTime</th>
              <!--<th class="cell100 column15">B2CUtilityAccountAvailableFunds</th>-->
              <th class="cell100 column16">Actions</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($b2ctransactions as $transaction)
            <tr class="row100 body">
                <td class="cell100 column1">{{ $transaction->order_id}}</td>
                <!--<td class="cell100 column2">{{-- $transaction->TransactionType --}}</td>
                <td class="cell100 column3">{{-- $transaction->B2CWorkingAccountAvailableFunds --}}</td>
                <td class="cell100 column4">{{-- $transaction->ResultCode --}}</td>-->
                <td class="cell100 column5">{{ $transaction->ResultDesc}}</td>
                <!--<td class="cell100 column6">{{-- $transaction->OriginatorConversationID --}}</td>
                <td class="cell100 column7">{{-- $transaction->ConversationID --}}</td>-->
                <td class="cell100 column8">{{  ($transaction->TransactionID)}}</td>
                <td class="cell100 column9">{{ $transaction->TransactionAmount}}</td>
                <td class="cell100 column10">{{ $transaction->TransactionReceipt}}</td>
                <!--<td class="cell100 column11">{{-- $transaction->B2CRecipientIsRegisteredCustomer --}}</td>
                <td class="cell100 column12">{{-- $transaction->B2CChargesPaidAccountAvailableFunds --}}</td>-->
                <td class="cell100 column13">{{ $transaction->ReceiverPartyPublicName}}</td>
                <td class="cell100 column14">{{ \Carbon\Carbon::parse($transaction->TransactionCompletedDateTime)->format('d/m/Y')}}</td>
                <!--<td class="cell100 column15">{{-- $transaction->B2CUtilityAccountAvailableFunds --}}</td>-->
                <td id="reverse-state" class="">
                    @if ($transaction->ResultCode == 0 && $transaction->Reversed == "false" )
                    <form id="transaction-reversal-form" class="px-4 py-3">
                      @csrf
                        <input type="hidden" name="transactionid" class="form-control" id="transactionid" placeholder="Transaction Id" value="{{ $transaction->TransactionID }}">
                        <input type="hidden" name="transaction_type" class="form-control" id="transaction_type"value="b2c">
                        <input type="hidden" name="transaction_id" class="form-control" id="transaction_id"value="{{ $transaction->id}} }}">
                        <input type="hidden" name="Amount" class="form-control" id="Amount" placeholder="Amount" value="{{ $transaction->TransactionAmount}}">
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
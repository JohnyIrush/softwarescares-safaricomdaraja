@extends('safaricomdaraja::layouts.app')

@section('content')
<div class="row">
  <div class="col-sm-4 mx-auto">
     <div class="card">
      <form id="transaction-reversal-form" class="px-4 py-3">
        @csrf
        <div class="form-group">
            <label for="transactionid">Transaction Id</label>
            <input type="text" name="transactionid" class="form-control" id="transactionid" placeholder="Transaction Id">
          </div>
        <div class="form-group">
          <label for="Amount">Amount</label>
          <input type="Number" name="Amount" class="form-control" id="Amount" placeholder="Amount">
        </div>
        <button type="submit" class="btn btn-primary">Reverse Transaction</button>
      </form>
     </div>
   </div>
 </div>
@endsection
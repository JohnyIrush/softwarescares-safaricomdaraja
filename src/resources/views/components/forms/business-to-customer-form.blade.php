@extends('safaricomdaraja::layouts.app')

@section('content')
<div class="row">
  <div class="col-sm-4 mx-auto">
     <div class="card">
      <form id="business-to-customer-form" class="px-4 py-3">
        @csrf
        <div class="form-group">
          <label for="Amount">Amount</label>
          <input type="Number" name="Amount" class="form-control" id="Amount" placeholder="Amount">
        </div>
        <div class="form-group">
          <label for="Phone">Phone Number</label>
          <input type="text" name="Phone" class="form-control" id="Phone" placeholder="Phone">
        </div>
        <button type="submit" class="btn btn-primary">Lipa Na Mpesa</button>
      </form>
     </div>
   </div>
 </div>
@endsection

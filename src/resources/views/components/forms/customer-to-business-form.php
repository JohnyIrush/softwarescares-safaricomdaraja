@extends('safaricomdaraja::layouts.app')

@section('content')
<div class="row">
  <div class="col-sm-4 mx-auto">
     <div class="card">
      <form id="customer-to-business-form" class="px-4 py-3">
        @csrf
        <div class="form-group">
          <label for="Account">Account</label>
          <input type="text" name="Account" class="form-control" id="Account" placeholder="Account">
        </div>
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

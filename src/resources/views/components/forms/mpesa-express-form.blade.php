@extends('safaricomdaraja::layouts.app')

@section('content')
@if(1 == 1)
    @forelse($notifications as $notification)
         
          @if ( isset(($notification->data)["errorMessage"]) == true)
          <div class="alert alert-danger" role="alert">
              {{ ($notification->data)["errorMessage"] }}
              <a href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
                Mark as read
              </a>
          </div>
          @endif
        
          @if (isset(($notification->data)["CustomerMessage"]) == true )
          <div class="alert alert-success" role="alert">
          {{ ($notification->data)["CustomerMessage"] }}.
            <a href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
              Mark as read
            </a>
          </div>
          @endif

        @if($loop->last)
            <a href="#" id="mark-all">
                Mark all as read
            </a>
        @endif
    @empty
        There are no new notifications
    @endforelse
@endif
<div class="row">
  <div class="col-sm-4 mx-auto">
     <div class="card">
      <form method="POST" action="{{ route("mpesaexpress") }}" class="px-4 py-3">
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

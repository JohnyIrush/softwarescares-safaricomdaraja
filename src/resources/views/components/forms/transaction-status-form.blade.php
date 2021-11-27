@extends('safaricomdaraja::layouts.app')

@section('content')
    <div class="card">
        <form id="transaction-status-form">
            @csrf
            <button type="submit" class="btn btn-primary">Check Transaction Status</button>
        </form>
    </div>
@endsection
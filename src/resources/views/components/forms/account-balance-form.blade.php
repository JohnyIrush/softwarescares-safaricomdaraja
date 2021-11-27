@extends('safaricomdaraja::layouts.app')

@section('content')
    <div class="card">
        <form id="account-balance-form">
            @csrf
            <button type="submit" class="btn btn-primary">Check Balance</button>
        </form>
    </div>
@endsection
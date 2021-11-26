@extends('safaricomdaraja::layouts.app')

@section('content')
    <div class="card">
        <form action="" method="post">
            @csrf
            <button type="submit" class="btn btn-primary">Check Balance</button>
        </form>
    </div>
@endsection
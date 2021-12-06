<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="/safaricomdaraja-js/mpesa-express-form1.js" defer></script>
    <script src="/safaricomdaraja-js/customer-to-business-form4.js" defer></script>
    <script src="/safaricomdaraja-js/business-to-customer-form5.js" defer></script>
    <script src="/safaricomdaraja-js/account-balance-form1.js" defer></script>
    <script src="/safaricomdaraja-js/transaction-reversal-form5.js" defer></script>
    <script src="/safaricomdaraja-js/transaction-status-form6" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <div id="app">
        <main>
            {{--Start Ajax Call waiting--}}
            <div class="modal hide" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
                <div class="modal-header">
                    <h1>Please Wait</h1>
                </div>
                <div class="modal-body">
                    <div id="ajax_loader">
                        <img src="~/Images/ajax-loader.gif" style="display: block; margin-left: auto; margin-right: auto;">
                    </div>
                </div>
            </div>
            {{--End Ajax Call waiting--}}
            @yield('content')
        </main>
    </div>
</body>
</html>
 
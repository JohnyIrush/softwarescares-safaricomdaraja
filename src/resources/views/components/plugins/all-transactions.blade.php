@extends('safaricomdaraja::layouts.tab-pane')

@section('content-tab')
<!-- Demo header-->
<section class="py-5 header">
    <div class="container py-4">
        <header class="text-center mb-5 pb-5 text-white">
            <h1 class="display-4">All Transactions</h1>
        </header>


        <div class="row">
            <div class="col-md-3">
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link mb-3 p-3 shadow active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Mpesa Express</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        <i class="fa fa-calendar-minus-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Customer To Business</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                        <i class="fa fa-star mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Business to Customer</span></a>

                    </div>
            </div>


            <div class="col-md-9">
                <!-- Tabs content -->
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane col-md-12 fade shadow rounded bg-white show active p-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <h4 class="font-italic mb-4">Mpesa Express Transactions</h4>
                        @include('safaricomdaraja::components.plugins.mpesa-express-transactions')
                    </div>
                    
                    <div class="tab-pane col-md-12 fade shadow rounded bg-white p-5" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <h4 class="font-italic mb-4">Customer To Business Transactions</h4>
                        @include('safaricomdaraja::components.plugins.customer-to-business-transactions')
                    </div>
                    
                    <div class="tab-pane col-md-12 fade shadow rounded bg-white p-5" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <h4 class="font-italic mb-4">Business to Customer Transactions</h4>
                        @include('safaricomdaraja::components.plugins.customer-to-business-transactions')
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
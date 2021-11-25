@extends('safaricomdaraja::layouts.table')

@section('content')
<!--Table-->

    <div class="container-table100">
        <div class="wrap-table100">



            <div class="table100 ver3 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">OrderId</th>
                                <th class="cell100 column2">TransactionType</th>
                                <th class="cell100 column3">B2CWorkingAccountAvailableFunds</th>
                                <th class="cell100 column4">ResultCode</th>
                                <th class="cell100 column5">ResultDesc</th>
                                <th class="cell100 column6">OriginatorConversationID</th>
                                <th class="cell100 column7">ConversationID</th>
                                <th class="cell100 column8">TransactionID</th>
                                <th class="cell100 column9">TransactionAmount</th>
                                <th class="cell100 column10">TransactionReceipt</th>
                                <th class="cell100 column11">B2CRecipientIsRegisteredCustomer</th>
                                <th class="cell100 column12">B2CChargesPaidAccountAvailableFunds</th>
                                <th class="cell100 column13">ReceiverPartyPublicName</th>
                                <th class="cell100 column14">TransactionCompletedDateTime</th>
                                <th class="cell100 column15">B2CUtilityAccountAvailableFunds</th>
                                <th class="cell100 column16">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table class="table table-responsive">
                        <tbody>

                        @foreach ($b2ctransactions as $transaction)
                            
                            <tr class="row100 body">
                                <td class="cell100 column1">{{ $transaction->order_id}}</td>
                                <td class="cell100 column2">{{ $transaction->TransactionType}}</td>
                                <td class="cell100 column3">{{ $transaction->B2CWorkingAccountAvailableFunds}}</td>
                                <td class="cell100 column4">{{ $transaction->ResultCode}}</td>
                                <td class="cell100 column5">{{ $transaction->ResultDesc}}</td>
                                <td class="cell100 column6">{{ $transaction->OriginatorConversationID}}</td>
                                <td class="cell100 column7">{{ $transaction->ConversationID}}</td>
                                <td class="cell100 column8">{{  ($transaction->TransactionID)}}</td>
                                <td class="cell100 column9">{{ $transaction->TransactionAmount}}</td>
                                <td class="cell100 column10">{{ $transaction->TransactionReceipt}}</td>
                                <td class="cell100 column11">{{ $transaction->B2CRecipientIsRegisteredCustomer}}</td>
                                <td class="cell100 column12">{{ $transaction->B2CChargesPaidAccountAvailableFunds}}</td>
                                <td class="cell100 column13">{{ $transaction->ReceiverPartyPublicName}}</td>
                                <td class="cell100 column14">{{ \Carbon\Carbon::parse($transaction->TransactionCompletedDateTime)->format('d/m/Y')}}</td>
                                <td class="cell100 column15">{{ $transaction->B2CUtilityAccountAvailableFunds}}</td>
                                <td class="cell100 column16">
                                <div class="dropdown show">
                                  <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Transaction Actions
                                  </a>
                                
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                      @if ($transaction->ResultCode == 0)
                                      <a class="dropdown-item" href="#">Reverse Transaction</a>
                                      @endif
                                      <a class="dropdown-item" href="#">Check Status</a>
                                  </div>
                                </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

           <!-- <div class="table100 ver1 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">Class name</th>
                                <th class="cell100 column2">Type</th>
                                <th class="cell100 column3">Hours</th>
                                <th class="cell100 column4">Trainer</th>
                                <th class="cell100 column5">Spots</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table>
                        <tbody>
                            <tr class="row100 body">
                                <td class="cell100 column1">Like a butterfly</td>
                                <td class="cell100 column2">Boxing</td>
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">Aaron Chapman</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Mind & Body</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Adam Stewart</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Crit Cardio</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">9:00 AM - 10:00 AM</td>
                                <td class="cell100 column4">Aaron Chapman</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Wheel Pose Full Posture</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">7:00 AM - 8:30 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Playful Dancer's Flow</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Zumba Dance</td>
                                <td class="cell100 column2">Dance</td>
                                <td class="cell100 column3">5:00 PM - 7:00 PM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Cardio Blast</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">5:00 PM - 7:00 PM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Pilates Reformer</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Supple Spine and Shoulders</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">6:30 AM - 8:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Yoga for Divas</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Virtual Cycle</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Like a butterfly</td>
                                <td class="cell100 column2">Boxing</td>
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">Aaron Chapman</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Mind & Body</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Adam Stewart</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Crit Cardio</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">9:00 AM - 10:00 AM</td>
                                <td class="cell100 column4">Aaron Chapman</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Wheel Pose Full Posture</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">7:00 AM - 8:30 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Playful Dancer's Flow</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Zumba Dance</td>
                                <td class="cell100 column2">Dance</td>
                                <td class="cell100 column3">5:00 PM - 7:00 PM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Cardio Blast</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">5:00 PM - 7:00 PM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Pilates Reformer</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Supple Spine and Shoulders</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">6:30 AM - 8:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Yoga for Divas</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Virtual Cycle</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">20</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>-->
            
            <!--<div class="table100 ver2 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">Class name</th>
                                <th class="cell100 column2">Type</th>
                                <th class="cell100 column3">Hours</th>
                                <th class="cell100 column4">Trainer</th>
                                <th class="cell100 column5">Spots</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table>
                        <tbody>
                            <tr class="row100 body">
                                <td class="cell100 column1">Like a butterfly</td>
                                <td class="cell100 column2">Boxing</td>
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">Aaron Chapman</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Mind & Body</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Adam Stewart</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Crit Cardio</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">9:00 AM - 10:00 AM</td>
                                <td class="cell100 column4">Aaron Chapman</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Wheel Pose Full Posture</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">7:00 AM - 8:30 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Playful Dancer's Flow</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Zumba Dance</td>
                                <td class="cell100 column2">Dance</td>
                                <td class="cell100 column3">5:00 PM - 7:00 PM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Cardio Blast</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">5:00 PM - 7:00 PM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Pilates Reformer</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Supple Spine and Shoulders</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">6:30 AM - 8:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Yoga for Divas</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Virtual Cycle</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Like a butterfly</td>
                                <td class="cell100 column2">Boxing</td>
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">Aaron Chapman</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Mind & Body</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Adam Stewart</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Crit Cardio</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">9:00 AM - 10:00 AM</td>
                                <td class="cell100 column4">Aaron Chapman</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Wheel Pose Full Posture</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">7:00 AM - 8:30 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Playful Dancer's Flow</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Zumba Dance</td>
                                <td class="cell100 column2">Dance</td>
                                <td class="cell100 column3">5:00 PM - 7:00 PM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Cardio Blast</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">5:00 PM - 7:00 PM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Pilates Reformer</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Supple Spine and Shoulders</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">6:30 AM - 8:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Yoga for Divas</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Virtual Cycle</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">20</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>--> 


            <!--
            <div class="table100 ver4 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">Class name</th>
                                <th class="cell100 column2">Type</th>
                                <th class="cell100 column3">Hours</th>
                                <th class="cell100 column4">Trainer</th>
                                <th class="cell100 column5">Spots</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table>
                        <tbody>
                            <tr class="row100 body">
                                <td class="cell100 column1">Like a butterfly</td>
                                <td class="cell100 column2">Boxing</td>
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">Aaron Chapman</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Mind & Body</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Adam Stewart</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Crit Cardio</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">9:00 AM - 10:00 AM</td>
                                <td class="cell100 column4">Aaron Chapman</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Wheel Pose Full Posture</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">7:00 AM - 8:30 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Playful Dancer's Flow</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Zumba Dance</td>
                                <td class="cell100 column2">Dance</td>
                                <td class="cell100 column3">5:00 PM - 7:00 PM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Cardio Blast</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">5:00 PM - 7:00 PM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Pilates Reformer</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Supple Spine and Shoulders</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">6:30 AM - 8:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Yoga for Divas</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Virtual Cycle</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Like a butterfly</td>
                                <td class="cell100 column2">Boxing</td>
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">Aaron Chapman</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Mind & Body</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Adam Stewart</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Crit Cardio</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">9:00 AM - 10:00 AM</td>
                                <td class="cell100 column4">Aaron Chapman</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Wheel Pose Full Posture</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">7:00 AM - 8:30 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Playful Dancer's Flow</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Zumba Dance</td>
                                <td class="cell100 column2">Dance</td>
                                <td class="cell100 column3">5:00 PM - 7:00 PM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Cardio Blast</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">5:00 PM - 7:00 PM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Pilates Reformer</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Supple Spine and Shoulders</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">6:30 AM - 8:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Yoga for Divas</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Virtual Cycle</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">20</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="table100 ver5 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">Class name</th>
                                <th class="cell100 column2">Type</th>
                                <th class="cell100 column3">Hours</th>
                                <th class="cell100 column4">Trainer</th>
                                <th class="cell100 column5">Spots</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table>
                        <tbody>
                            <tr class="row100 body">
                                <td class="cell100 column1">Like a butterfly</td>
                                <td class="cell100 column2">Boxing</td>
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">Aaron Chapman</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Mind & Body</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Adam Stewart</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Crit Cardio</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">9:00 AM - 10:00 AM</td>
                                <td class="cell100 column4">Aaron Chapman</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Wheel Pose Full Posture</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">7:00 AM - 8:30 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Playful Dancer's Flow</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Zumba Dance</td>
                                <td class="cell100 column2">Dance</td>
                                <td class="cell100 column3">5:00 PM - 7:00 PM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Cardio Blast</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">5:00 PM - 7:00 PM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Pilates Reformer</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Supple Spine and Shoulders</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">6:30 AM - 8:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Yoga for Divas</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Virtual Cycle</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Like a butterfly</td>
                                <td class="cell100 column2">Boxing</td>
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">Aaron Chapman</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Mind & Body</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Adam Stewart</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Crit Cardio</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">9:00 AM - 10:00 AM</td>
                                <td class="cell100 column4">Aaron Chapman</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Wheel Pose Full Posture</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">7:00 AM - 8:30 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Playful Dancer's Flow</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Zumba Dance</td>
                                <td class="cell100 column2">Dance</td>
                                <td class="cell100 column3">5:00 PM - 7:00 PM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Cardio Blast</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">5:00 PM - 7:00 PM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Pilates Reformer</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">10</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Supple Spine and Shoulders</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">6:30 AM - 8:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">15</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Yoga for Divas</td>
                                <td class="cell100 column2">Yoga</td>
                                <td class="cell100 column3">9:00 AM - 11:00 AM</td>
                                <td class="cell100 column4">Donna Wilson</td>
                                <td class="cell100 column5">20</td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column1">Virtual Cycle</td>
                                <td class="cell100 column2">Gym</td>
                                <td class="cell100 column3">8:00 AM - 9:00 AM</td>
                                <td class="cell100 column4">Randy Porter</td>
                                <td class="cell100 column5">20</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            -->
        </div>
    </div>

<!--Table-->
@endsection
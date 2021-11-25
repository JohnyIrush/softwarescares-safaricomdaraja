<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Softwarescares\Safaricomdaraja\app\Models\CustomerToBusinessTransaction;

class CustomerToBusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomerToBusinessTransaction::truncate();

        CustomerToBusinessTransaction::create(
            [
                    "TransactionType" => "Pay Bill",
                    "TransID" => "RKTQDM7W6S",
                    "TransTime" => "20191122063845",
                    "TransAmount" => "10",
                    "BusinessShortCode" => "600638",
                    "BillRefNumber" => "254708374149",
                    "InvoiceNumber" => "",
                    "OrgAccountBalance" => "49197.00",
                    "ThirdPartyTransID" => "",
                    "MSISDN" => "254708374149",
                    "FirstName" => "John",
                    "MiddleName" => "",
                    "LastName" => "Doe",
                    "order_id" => 1

            ]);

            CustomerToBusinessTransaction::create(
                [
                        "TransactionType" => "Pay Bill",
                        "TransID" => "RKTQDM7W6S",
                        "TransTime" => "20191122063845",
                        "TransAmount" => "1",
                        "BusinessShortCode" => "600638",
                        "BillRefNumber" => "25470374149",
                        "InvoiceNumber" => "",
                        "OrgAccountBalance" => "491.00",
                        "ThirdPartyTransID" => "",
                        "MSISDN" => "254708374149",
                        "FirstName" => "John",
                        "MiddleName" => "",
                        "LastName" => "Doe",
                        "order_id" => 2
    
                ]
        );
    }
}

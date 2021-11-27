<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Softwarescares\Safaricomdaraja\app\Models\BusinessToCustomerTransaction;

class BusinessToCustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BusinessToCustomerTransaction::truncate();

        $result = json_decode('{    
            "Result": {
               "ResultType": 0,
               "ResultCode": 0,
               "ResultDesc": "The service request is processed successfully.", 
               "OriginatorConversationID": "10571-7910404-1",
               "ConversationID": "AG_20191219_00004e48cf7e3533f581",
               "TransactionID": "NLJ41HAY6Q",
               "ResultParameters": {
                  "ResultParameter": [
                   {
                      "Key": "TransactionAmount",
                      "Value": 10
                   },
                   {
                      "Key": "TransactionReceipt",
                      "Value": "NLJ41HAY6Q"
                   },
                   {
                      "Key": "B2CRecipientIsRegisteredCustomer",
                      "Value": "Y"
                   },
                   {
                      "Key": "B2CChargesPaidAccountAvailableFunds",
                      "Value": -4510.00
                   },
                   {
                      "Key": "ReceiverPartyPublicName",
                      "Value": "254708374149 - John Doe"
                   },
                   {
                      "Key": "TransactionCompletedDateTime",
                      "Value": "19.12.2019 11:45:50"
                   },
                   {
                      "Key": "B2CUtilityAccountAvailableFunds",
                      "Value": 10116.00
                   },
                   {
                      "Key": "B2CWorkingAccountAvailableFunds",
                      "Value": 900000.00
                   }
                 ]
               },
               "ReferenceData": {
                  "ReferenceItem": {
                     "Key": "QueueTimeoutURL",
                     "Value": "https:\/\/internalsandbox.safaricom.co.ke\/mpesa\/b2cresults\/v1\/submit"
                   }
               }
            }
         }');
     

        BusinessToCustomerTransaction::create(

            [
               "ResultType" => $result->Result->ResultType,                       
               "ResultCode" => $result->Result->ResultCode,            
               "ResultDesc" => $result->Result->ResultDesc,
               "OriginatorConversationID" =>   $result->Result->OriginatorConversationID,
               "ConversationID" => $result->Result->ConversationID,
               "TransactionID" => $result->Result->TransactionID,
               "TransactionAmount" => $result->Result->ResultParameters->ResultParameter[0]->Value,
               "TransactionReceipt" => $result->Result->ResultParameters->ResultParameter[1]->Value,
               "B2CWorkingAccountAvailableFunds" => $result->Result->ResultParameters->ResultParameter[7]->Value,
               "B2CRecipientIsRegisteredCustomer" => $result->Result->ResultParameters->ResultParameter[2]->Value,
               "B2CChargesPaidAccountAvailableFunds" => $result->Result->ResultParameters->ResultParameter[3]->Value,
               "ReceiverPartyPublicName" => $result->Result->ResultParameters->ResultParameter[4]->Value,
               "TransactionCompletedDateTime" => $result->Result->ResultParameters->ResultParameter[5]->Value,
               "B2CUtilityAccountAvailableFunds" => $result->Result->ResultParameters->ResultParameter[6]->Value,
               'order_id' => 1

            ]
        );

        $result = json_decode('{
            "Result": {
               "ResultType": 0,
               "ResultCode": 2001,
               "ResultDesc": "The initiator information is invalid.",
               "OriginatorConversationID": "29112-34801843-1",
               "ConversationID": "AG_20191219_00006c6fddb15123addf",
               "TransactionID": "NLJ0000000",
               "ReferenceData": {
                 "ReferenceItem": {
                     "Key": "QueueTimeoutURL",
                     "Value": "https:\/\/internalsandbox.safaricom.co.ke\/mpesa\/b2cresults\/v1\/submit"
                   }
               }
            }}');
        BusinessToCustomerTransaction::create(

         [
            "ResultType" => $result->Result->ResultType,                     
            "ResultCode" => $result->Result->ResultCode,            
            "ResultDesc" => $result->Result->ResultDesc,
            "OriginatorConversationID" =>   $result->Result->OriginatorConversationID,
            "ConversationID" => $result->Result->ConversationID,
            "TransactionID" => $result->Result->TransactionID,
            "TransactionAmount" => isset($result->Result->ResultParameters->ResultParameter[0]->Value)? $result->Result->ResultParameters->ResultParameter[0]->Value: null,
            "TransactionReceipt" => isset($result->Result->ResultParameters->ResultParameter[1]->Value)? $result->Result->ResultParameters->ResultParameter[1]->Value: null,
            "B2CWorkingAccountAvailableFunds" => isset($result->Result->ResultParameters->ResultParameter[7]->Value)? $result->Result->ResultParameters->ResultParameter[7]->Value:null ,
            "B2CRecipientIsRegisteredCustomer" => isset($result->Result->ResultParameters->ResultParameter[2]->Value)? :null ,
            "B2CChargesPaidAccountAvailableFunds" => isset($result->Result->ResultParameters->ResultParameter[3]->Value)? $result->Result->ResultParameters->ResultParameter[3]->Value: null,
            "ReceiverPartyPublicName" => isset($result->Result->ResultParameters->ResultParameter[4]->Value)? $result->Result->ResultParameters->ResultParameter[4]->Value: null,
            "TransactionCompletedDateTime" => isset($result->Result->ResultParameters->ResultParameter[5]->Value)? $result->Result->ResultParameters->ResultParameter[5]->Value: null,
            "B2CUtilityAccountAvailableFunds" => isset($result->Result->ResultParameters->ResultParameter[6]->Value)? $result->Result->ResultParameters->ResultParameter[6]->Value: null,
            'order_id' => 2
         ]
     );
    }
}

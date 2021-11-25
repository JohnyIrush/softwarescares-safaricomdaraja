<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Softwarescares\Safaricomdaraja\app\Models\MpesaExpressTransaction;

class MpesaExpressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MpesaExpressTransaction::truncate();

        $result = json_decode('{    
         "Body": {        
            "stkCallback": {            
               "MerchantRequestID": "29115-34620561-1",            
               "CheckoutRequestID": "ws_CO_191220191020363925",            
               "ResultCode": 0,            
               "ResultDesc": "The service request is processed successfully.",            
               "CallbackMetadata": {                
                  "Item": [{                        
                     "Name": "Amount",                        
                     "Value": 1.00                    
                  },                    
                  {                        
                     "Name": "MpesaReceiptNumber",                        
                     "Value": "NLJ7RT61SV"                    
                  },                    
                  {                        
                     "Name": "TransactionDate",                        
                     "Value": 20191219102115                    
                  },                    
                  {                        
                     "Name": "PhoneNumber",                        
                     "Value": 254708374149                    
                  }]            
               }        
            }    
         }
      }');
     

        MpesaExpressTransaction::create(

            [
               "MerchantRequestID" => $result->Body->stkCallback->MerchantRequestID,            
               "CheckoutRequestID" => $result->Body->stkCallback->CheckoutRequestID,            
               "ResultCode" => $result->Body->stkCallback->ResultCode,            
               "ResultDesc" => $result->Body->stkCallback->ResultDesc,
               "Amount" =>   isset($result->Body->stkCallback->CallbackMetadata->Item[0]->Value)? $result->Body->stkCallback->CallbackMetadata->Item[0]->Value : null,
               "MpesaReceiptNumber" => isset($result->Body->stkCallback->CallbackMetadata->Item[1]->Value)? $result->Body->stkCallback->CallbackMetadata->Item[1]->Value : null,
               "TransactionDate" => isset($result->Body->stkCallback->CallbackMetadata->Item[2]->Value)? $result->Body->stkCallback->CallbackMetadata->Item[2]->Value: null,
               "PhoneNumber" => isset($result->Body->stkCallback->CallbackMetadata->Item[3]->Value)? $result->Body->stkCallback->CallbackMetadata->Item[3]->Value : null,
               'order_id' => 1
            ]
        );

        $result = json_decode('{    
         "Body": {
            "stkCallback": {
               "MerchantRequestID": "29115-34620561-1",
               "CheckoutRequestID": "ws_CO_191220191020363925",
               "ResultCode": 1032,
               "ResultDesc": "Request cancelled by user."
            }
         }
      }');
        MpesaExpressTransaction::create(

         [
            "MerchantRequestID" => $result->Body->stkCallback->MerchantRequestID,            
            "CheckoutRequestID" => $result->Body->stkCallback->CheckoutRequestID,            
            "ResultCode" => $result->Body->stkCallback->ResultCode,            
            "ResultDesc" => $result->Body->stkCallback->ResultDesc,
            "Amount" =>   isset($result->Body->stkCallback->CallbackMetadata->Item[0]->Value)? $result->Body->stkCallback->CallbackMetadata->Item[0]->Value : null,
            "MpesaReceiptNumber" => isset($result->Body->stkCallback->CallbackMetadata->Item[1]->Value)? $result->Body->stkCallback->CallbackMetadata->Item[1]->Value : null,
            "TransactionDate" => isset($result->Body->stkCallback->CallbackMetadata->Item[2]->Value)? $result->Body->stkCallback->CallbackMetadata->Item[2]->Value: null,
            "PhoneNumber" => isset($result->Body->stkCallback->CallbackMetadata->Item[3]->Value)? $result->Body->stkCallback->CallbackMetadata->Item[3]->Value : null,
            'order_id' => 2
         ]
     );
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessToCustomerTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_to_customer_transactions', function (Blueprint $table) {
            $table->id();
            $table->text("order_id");  
            $table->text("ResultType");                     
            $table->text("ResultCode"); 
            $table->text("B2CWorkingAccountAvailableFunds")->nullable();          
            $table->text("ResultDesc");
            $table->text("OriginatorConversationID");
            $table->text("ConversationID");
            $table->text("TransactionID");
            $table->text("TransactionAmount")->nullable();
            $table->text("TransactionReceipt")->nullable();
            $table->text("B2CRecipientIsRegisteredCustomer")->nullable();
            $table->text("B2CChargesPaidAccountAvailableFunds")->nullable();
            $table->text("ReceiverPartyPublicName")->nullable();
            $table->text("TransactionCompletedDateTime")->nullable();
            $table->text("B2CUtilityAccountAvailableFunds")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_to_customer_transactions');
    }
}

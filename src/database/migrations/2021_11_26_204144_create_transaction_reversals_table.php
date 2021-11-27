<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionReversalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_reversals', function (Blueprint $table) {
            $table->id();  
            $table->text("ResultType");                     
            $table->text("ResultCode");      
            $table->text("ResultDesc");
            $table->text("OriginatorConversationID");
            $table->text("ConversationID");
            $table->text("TransactionID");
            $table->text("DebitAccountBalance");
            $table->text("Amount");
            $table->text("TransCompletedTime");
            $table->text("OriginalTransactionID");
            $table->text("Charge");
            $table->text("CreditPartyPublicName");
            $table->text("DebitPartyPublicName");
            $table->text("transaction_id");
            $table->text("transaction_type");
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
        Schema::dropIfExists('transaction_reversals');
    }
}

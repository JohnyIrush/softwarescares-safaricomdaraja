<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpesaExpressTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpesa_express_transactions', function (Blueprint $table) {
            $table->id();
            $table->text("MerchantRequestID")->nullable();            
            $table->text("CheckoutRequestID")->nullable();            
            $table->text("ResultCode")->nullable();            
            $table->text("ResultDesc")->nullable();
            $table->integer("Amount")->nullable();
            $table->text("MpesaReceiptNumber")->nullable();
            $table->timestamp("TransactionDate")->nullable();
            $table->text("PhoneNumber")->nullable();
            $table->integer('order_id')->nullable();
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
        Schema::dropIfExists('mpesa_express_transactions');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerToBusinessTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_to_business_transactions', function (Blueprint $table) {
            $table->id();
            $table->string("TransactionType");
            $table->string("TransID");
            $table->string("TransTime");
            $table->string("TransAmount");
            $table->string("BusinessShortCode");
            $table->string("BillRefNumber");
            $table->string("InvoiceNumber");
            $table->string("OrgAccountBalance");
            $table->string("ThirdPartyTransID");
            $table->string("MSISDN");
            $table->string("FirstName");
            $table->string("MiddleName");
            $table->string("LastName");
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
        Schema::dropIfExists('customer_to_business_transactions');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
    //  */

    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('txnId')->unique();
            $table->string('validationNumber');
            $table->double('amount', 15, 2);
            $table->string('customerName');
            $table->string('revenueHead');
            $table->string('bankName');
            $table->string('paymentMethod');
            $table->dateTime('paymentDate');
            $table->boolean('processed')->default(0);
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
        Schema::dropIfExists('transactions');
    }
}

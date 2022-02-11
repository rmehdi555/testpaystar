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
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('user_bank_details_id');
            $table->foreign('user_bank_details_id')->references('id')->on('user_bank_details');
            $table->string('amount');
            $table->string('description')->nullable();
            $table->string('destinationFirstname');
            $table->string('destinationLastname');
            $table->string('destinationNumber');
            $table->string('inquiryDate')->nullable();
            $table->string('inquirySequence')->nullable();
            $table->string('message')->nullable();
            $table->string('refCode')->nullable();
            $table->string('sourceFirstname')->nullable();
            $table->string('sourceLastname')->nullable();
            $table->string('sourceNumber')->nullable();
            $table->char('type',10)->default('paya');
            $table->char('status',10)->default('PENDING');
            $table->softDeletes();
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

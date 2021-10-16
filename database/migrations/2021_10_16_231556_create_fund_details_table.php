<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fund_id');
            $table->foreignId('user_id');
            $table->integer('unit')->unsigned();
            $table->foreignId('payment_method_id');
            $table->foreignId('purchase_status_id');
            $table->foreignId('verification_by');
            $table->timestamps();

            $table->foreign('fund_id')->references('id')->on('funds');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->foreign('purchase_status_id')->references('id')->on('purchase_statuses');
            $table->foreign('verification_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fund_details');
    }
}

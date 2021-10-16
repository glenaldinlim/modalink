<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id');
            $table->foreignId('fund_type_id');
            $table->string('name');
            $table->text('description');
            $table->integer('tenor')->unsigned()->default(3);
            $table->decimal('interest_rate', 4, 2)->default(0);
            $table->bigInteger('fund_target')->unsigned();
            $table->date('deadline');
            $table->bigInteger('price_per_unit')->default(100000);
            $table->foreignId('fund_status_id')->default(1);
            $table->timestamps();

            $table->foreign('merchant_id')->references('id')->on('merchants');
            $table->foreign('fund_type_id')->references('id')->on('fund_types');
            $table->foreign('fund_status_id')->references('id')->on('fund_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funds');
    }
}

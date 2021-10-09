<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name');
            $table->string('phone')->nullable()->default(NULL);
            $table->year('since');
            $table->foreignId('business_type_id');
            $table->foreignId('business_category_id');
            $table->string('siup_path')->nullable()->default(NULL)->comment('Surat Izin Usaha Perdagangan (SIUP)');
            $table->string('nib_path')->nullable()->default(NULL)->comment('Nomor Induk Berusaha (NIB)');
            $table->string('skdp_tdp_path')->nullable()->default(NULL)->comment('SKDP atau TDP');
            $table->string('deed_company_path')->nullable()->default(NULL)->comment('Akta Perusahaan');
            $table->string('avatar')->default('merchants/default.jpg');
            $table->foreignId('status_id')->default(1);
            $table->foreignId('verification_status_id')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('business_type_id')->references('id')->on('business_types');
            $table->foreign('business_category_id')->references('id')->on('business_categories');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('verification_status_id')->references('id')->on('verification_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants');
    }
}

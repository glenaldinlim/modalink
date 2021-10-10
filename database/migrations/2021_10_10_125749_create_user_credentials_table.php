<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_credentials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('job');
            $table->date('birthdate')->default('1997-01-01');
            $table->string('username');
            $table->string('idcard')->nullable()->default(NULL);
            $table->string('idcard_path')->nullable()->default(NULL);
            $table->string('npwp')->nullable()->default(NULL);
            $table->string('npwp_path')->nullable()->default(NULL);
            $table->foreignId('status_id')->default(1);
            $table->foreignId('verification_status_id')->default(1);
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('user_credentials');
    }
}

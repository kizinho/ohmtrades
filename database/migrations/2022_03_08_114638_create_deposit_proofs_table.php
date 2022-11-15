<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositProofsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('deposit_proofs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('path');
            $table->unsignedBigInteger('invest_id')->nullable();
            $table->unsignedBigInteger('education_id')->nullable();
            $table->unsignedBigInteger('user_money_id')->nullable();
            $table->timestamps();
            $table->foreign('invest_id')
                    ->references('id')->on('investments')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('education_id')
                    ->references('id')->on('user_education_license_plans')
                    ->onDelete('cascade')->onUpdate('cascade');
             $table->foreign('user_money_id')
                    ->references('id')->on('user_withdrawals')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('deposit_proofs');
    }

}

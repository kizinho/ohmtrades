<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_id');
            $table->unsignedBigInteger('user_id');
            $table->longText('description');
            $table->longText('address');
            $table->longText('address_name');
            $table->integer('invest_id')->nullable();
            $table->longText('withdraw_from')->nullable();
            $table->decimal('withdraw_charge', 24, 2)->default(0);
            $table->string('amount_check')->default(0);
            $table->decimal('amount', 24, 2)->default(0);
            $table->decimal('total_amount', 24, 2);
            $table->longText('message')->nullable();
            $table->boolean('confirm')->default(0);
            $table->boolean('status')->default(0);
            $table->boolean('status_withdraw')->default(0);
            $table->timestamps();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');


            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('withdraws');
    }

}

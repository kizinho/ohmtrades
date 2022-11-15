<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWithdrawalsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_withdrawals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('coin_id');
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->decimal('amount', 24, 2)->default(0);
            $table->boolean('status')->default(0);
             $table->string('amount_check')->default(0);
            $table->boolean('main_invest')->default(0);
            $table->boolean('main_paid')->default(0);
            $table->boolean('deposit_user_paid')->default(0);
            $table->boolean('user_deposit')->default(0);

            $table->text('type');
            $table->timestamps();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('coin_id')
                    ->references('id')->on('user_coins')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('plan_id')
                    ->references('id')->on('plans')
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
        Schema::dropIfExists('user_withdrawals');
    }

}

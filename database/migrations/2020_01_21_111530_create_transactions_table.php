<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('transaction_id');
            $table->text('type')->nullabel();
            $table->text('name_type')->nullabel();
            $table->unsignedBigInteger('coin_id')->nullable();
            $table->decimal('amount', 24, 2)->default(0);
            $table->decimal('amount_profit', 24, 6)->default(0);
            $table->longText('description');
            $table->decimal('deposit_investment_charge', 24)->default(0);
            $table->decimal('withdraw_charge', 24, 2)->default(0);
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('coin_id')
                    ->references('id')->on('user_coins')
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
        Schema::dropIfExists('transactions');
    }

}

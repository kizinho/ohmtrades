<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordPaymentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('record_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('transaction_id');
            $table->boolean('status')->default(0);
            $table->integer('level');
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('payer_id');
            $table->decimal('amount', 24, 2)->default(0);
            $table->text('type');
            $table->timestamps();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payer_id')
                    ->references('id')->on('users');
            $table->foreign('plan_id')
                    ->references('id')->on('plans');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('record_payments');
    }

}

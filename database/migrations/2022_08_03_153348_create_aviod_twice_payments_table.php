<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAviodTwicePaymentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('aviod_twice_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reciever_id');
            $table->integer('level');
            $table->unsignedBigInteger('payer_id')->nullable();
            $table->text('type');
            $table->timestamps();
            $table->foreign('reciever_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payer_id')
                    ->references('id')->on('users');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('aviod_twice_payments');
    }

}

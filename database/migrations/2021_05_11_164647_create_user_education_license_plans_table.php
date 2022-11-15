<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEducationLicensePlansTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_education_license_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('education_license_id');
            $table->decimal('amount', 24, 2)->default(0);
            $table->string('amount_check')->default(0);
            $table->dateTime('due_pay')->nullable();
            $table->boolean('status_deposit')->default(0);
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('education_license_id')
                    ->references('id')->on('education_license_plans')
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
        Schema::dropIfExists('user_education_license_plans');
    }

}

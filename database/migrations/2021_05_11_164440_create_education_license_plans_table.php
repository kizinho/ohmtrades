<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationLicensePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_license_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->decimal('amount',24)->default(0);
            $table->unsignedBigInteger('compound_id');
            $table->timestamps();
            $table->foreign('compound_id')
                    ->references('id')->on('compounds')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education_license_plans');
    }
}

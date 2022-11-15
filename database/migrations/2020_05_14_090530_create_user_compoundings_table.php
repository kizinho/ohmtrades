<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCompoundingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_compoundings', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->string('transaction_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('coin_id');
            $table->unsignedBigInteger('compound_id');
            $table->decimal('amount',24,2)->default(0);
            $table->decimal('amount_check',24,2)->default(0);
            $table->decimal('earn',24,2)->default(0);
            $table->string('run_count')->default(0);
            $table->dateTime('due_pay')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('coin_id')
                    ->references('id')->on('coins')
                    ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('user_compoundings');
    }
}

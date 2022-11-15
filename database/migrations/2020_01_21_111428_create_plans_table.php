<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->float('min', 24)->default(0);
            $table->float('max', 24)->default(0);
            $table->decimal('percentage')->default(0);
            $table->decimal('insurance')->default(0);
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
    public function down() {
        Schema::dropIfExists('plans');
    }

}

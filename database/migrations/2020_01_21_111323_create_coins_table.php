<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('coins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 119)->unique();
            $table->string('slug', 119)->unique();
            $table->longText('address')->nullable();
            $table->longText('photo')->nullable();
            $table->boolean('status')->default(0);
            $table->longText('api_key')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('coins');
    }

}

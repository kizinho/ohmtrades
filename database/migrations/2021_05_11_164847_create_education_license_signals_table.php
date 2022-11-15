<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationLicenseSignalsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('education_license_signals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trading_pair');
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->longText('image')->nullable();
            $table->decimal('price', 24, 8)->default(0);
            $table->longText('analytic_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('education_license_signals');
    }

}

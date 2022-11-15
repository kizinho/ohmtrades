<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColSettings extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('settings', function (Blueprint $table) {
            $table->decimal('level_eduction_license_1')->default(0);
            $table->decimal('level_eduction_license_2_7')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('level_eduction_license_1');
            $table->decimal('level_eduction_license_2_7')->default(0);
        });
    }

}

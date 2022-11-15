<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettings extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('settings', function (Blueprint $table) {
            $table->decimal('level_all')->default(1);
            $table->decimal('founder_pool', 24, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('level_all');
            $table->dropColumn('founder_pool');
        });
    }

}

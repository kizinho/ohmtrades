<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_super')->default(0);
            $table->boolean('is_diamond')->default(0);
            $table->integer('ref_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_super');
            $table->dropColumn('is_diamond');
            $table->dropColumn('ref_count');
        });
    }

}

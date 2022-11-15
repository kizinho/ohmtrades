<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('type')->nullable();
            $table->string('email')->unique();
            $table->string('phone_no')->nullable();
            $table->string('ref_check', 119)->unique()->nullable();
            $table->boolean('code')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->dateTime('last_login')->nullable();
            $table->string('last_ip')->nullable();
            $table->string('verified_code', 119)->unique()->nullable();
            $table->boolean('can_withdraw')->default(0);
            $table->longText('google2fa_secret')->nullable();
            $table->date('google2fa_ts')->nullable();
            $table->boolean('google2fa_secret_status')->default(0);
            $table->string('nick_name')->nullable();
            $table->string('country')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('fb')->nullable();
            $table->string('tw')->nullable();
            $table->string('skyp')->nullable();
            $table->string('insta')->nullable();
            $table->string('tele')->nullable();
            $table->integer('support_code')->nullable();
            $table->string('photo')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }

}

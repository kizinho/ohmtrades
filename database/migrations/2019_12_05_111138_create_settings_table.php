<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('site_email')->nullable();
            $table->text('site_phone')->nullable();
            $table->text('send_notify_email')->nullable();
            $table->decimal('ref_percentage')->default(0);
            $table->string('time_pay')->default(2);
            $table->decimal('level_1')->default(0);
            $table->decimal('level_2')->default(0);
            $table->decimal('level_3')->default(0);
            $table->longText('site_name')->nullable();
            $table->longText('address')->nullable();
            $table->longText('site_url')->nullable();
            $table->longText('site_code')->nullable();
            $table->longText('logo')->nullable();
            $table->longText('favicon')->nullable();
            $table->longText('location_map')->nullable();
              
            $table->longText('location')->nullable();
            $table->longText('video_link')->nullable();
            $table->longText('copy_right')->nullable();
            $table->longText('block_io_pin')->nullable();
            $table->decimal('deposit_investment_charge')->default(0);
            $table->decimal('withdraw_charge')->default(0);
            $table->decimal('min_withdraw')->default(0);
            $table->boolean('investment_payment_mode')->default(0);
            $table->boolean('auto_withdraw')->default(1);
            $table->binary('email_body');
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
        Schema::dropIfExists('settings');
    }

}

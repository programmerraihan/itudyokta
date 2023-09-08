<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('branch_id')->nullable();
            $table->text('phon')->nullable();

            $table->text('instagram')->nullable();
            $table->text('pinterest')->nullable();
            $table->text('youtube')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();

            $table->text('address1')->nullable();
            $table->text('phone1')->nullable();
            $table->text('gmail1')->nullable();

            $table->text('address2')->nullable();
            $table->text('phone2')->nullable();
            $table->text('gmail2')->nullable();

            $table->text('logo')->nullable();
            $table->text('icon')->nullable();
            $table->text('start_day_time')->nullable();

            $table->text('facebook_embed')->nullable();
            $table->text('google_embed')->nullable();

            $table->tinyInteger('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_settings');
    }
};

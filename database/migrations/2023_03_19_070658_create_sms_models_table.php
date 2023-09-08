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
        Schema::create('sms_models', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('branch_id');
            $table->integer('course_title_id');
            $table->integer('batch_id');
            $table->integer('session_id');

            $table->text('date');
            $table->text('sms');
            $table->string('email');
            $table->string('mobile');
            $table->string('name');
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
        Schema::dropIfExists('sms_models');
    }
};

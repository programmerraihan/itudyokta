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
        Schema::create('branch_s_m_s', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
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
        Schema::dropIfExists('branch_s_m_s');
    }
};

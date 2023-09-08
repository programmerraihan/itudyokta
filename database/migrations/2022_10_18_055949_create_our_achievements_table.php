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
        Schema::create('our_achievements', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();

            $table->string('student')->nullable();
            $table->string('instructor')->nullable();
            $table->string('tutorial')->nullable();
            $table->string('employee')->nullable();
            $table->tinyInteger('status')->nullable();

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
        Schema::dropIfExists('our_achievements');
    }
};

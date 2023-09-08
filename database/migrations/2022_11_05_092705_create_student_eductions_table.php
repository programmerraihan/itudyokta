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
        Schema::create('student_eductions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->integer('branch_id')->nullable();
            //StudentEduction 
            $table->string('board_name')->nullable();
            $table->string('roll_no')->nullable();
            $table->string('reg_no')->nullable();
            $table->string('year')->nullable();

            $table->string('last_education_board')->nullable();
            $table->string('last_education_roll')->nullable();
            $table->string('last_education_reg')->nullable();
            $table->string('last_education_year')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('student_eductions');
    }
};

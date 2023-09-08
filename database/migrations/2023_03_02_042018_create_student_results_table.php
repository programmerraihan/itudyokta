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
        Schema::create('student_results', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');

            $table->integer('branch_id')->nullable();
            $table->integer('course_title_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->integer('batch_id')->nullable();

            $table->integer('user_id');
            $table->string('mcq_result')->nullable();
            $table->string('assessment_result')->nullable();
            $table->string('viva_result')->nullable();
            $table->string('total_mark')->nullable();
            $table->string('grade')->nullable();
            $table->text('date')->nullable();
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
        Schema::dropIfExists('student_results');
    }
};

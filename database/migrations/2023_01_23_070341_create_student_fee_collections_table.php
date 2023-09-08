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
        Schema::create('student_fee_collections', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();
            $table->integer('memo_no');
            $table->integer('student_id');
            $table->integer('session_id');
            $table->integer('course_title_id');
            $table->integer('schedule_id');
            $table->integer('batch_id');
            $table->integer('enrollment_id')->nullable();
            $table->integer('fee_id');
            $table->integer('ac_head_id')->nullable();
            $table->double('due');
            $table->double('amount');
            $table->double('paid');
            $table->double('discount')->nullable();
            $table->string('discount_note')->nullable();
            $table->double('fine')->nullable();
            $table->integer('fund_id');
            $table->date('date')->nullable();
            $table->tinyInteger('status')->default(1);


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
        Schema::dropIfExists('student_fee_collections');
    }
};

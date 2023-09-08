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
        Schema::create('student_fees', function (Blueprint $table) {

            $table->id();
            $table->integer('session_id');
            $table->integer('branch_id');
            $table->integer('enrollment_id')->nullable();
            $table->integer('course_title_id');
            $table->integer('batch_id');
            $table->integer('student_id');
            $table->integer('account_head_id')->nullable();
            $table->text('fee_date')->nullable();
            $table->string('title')->nullable();
            $table->date('next_due_date')->nullable();
            $table->double('amount');
            $table->double('paid')->nullable();
            $table->double('discount')->nullable();
            $table->double('due')->nullable();
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
        Schema::dropIfExists('student_fees');
    }
};

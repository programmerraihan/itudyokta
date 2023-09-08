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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')->nullable();
            $table->foreignId('course_title_id')->nullable();
            $table->foreignId('session_id')->nullable();
            $table->foreignId('branch_id')->nullable();
            $table->foreignId('batch_id')->nullable();
            $table->foreignId('schedule_id')->nullable();

            $table->float('price', 10, 2)->default(0);
            $table->float('payable_amount', 10, 2)->default(0);
            $table->float('due_amount', 10, 2)->default(0);
            $table->text('next_due_date')->nullable();
            $table->text('course_start_date')->nullable();


            $table->tinyInteger('student_status')->default(0);

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
        Schema::dropIfExists('enrollments');
    }
};

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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->foreignId('session_id');
            $table->foreignId('branch_id');
            $table->foreignId('batch_id');
            $table->foreignId('schedule_id');
            $table->foreignId('course_title_id');
            $table->foreignId('teacher_id');
            

            $table->string('sample_copy')->nullable();
            $table->longText('description')->nullable();
            $table->text('submission_end_deadline')->nullable();
            $table->text('submission_deadline')->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
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
        Schema::dropIfExists('assignments');
    }
};

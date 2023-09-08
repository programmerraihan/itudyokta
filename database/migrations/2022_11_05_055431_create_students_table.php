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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('login_status')->default(0);
            $table->rememberToken();

            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->text('date_of_birth')->nullable();
            $table->string('mobile')->nullable();
            $table->string('gender')->nullable();
            $table->string('religion')->nullable();
            $table->string('nationality')->nullable();

            $table->foreignId('course_title_id')->nullable();
            $table->foreignId('branch_id')->nullable();


            $table->string('image')->nullable();
            $table->string('nid')->nullable();
            $table->string('certificate')->nullable();
            $table->string('signature')->nullable();

            $table->string('reg_no_student')->nullable();
            $table->string('roll_no_student')->nullable();
            $table->string('director')->nullable();


            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('student_status')->default(0);

            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('students');
    }
};

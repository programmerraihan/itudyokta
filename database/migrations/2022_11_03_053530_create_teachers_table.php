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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();

            $table->string('name');
           
            $table->string('photo')->nullable();
            $table->string('edu_qualification')->nullable();
            $table->string('teacher_code')->nullable();
            $table->string('designation')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('phone');
            $table->string('email');

            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('nationality')->nullable();
            $table->string('gender')->nullable();
            $table->string('religion')->nullable();

            $table->date('birth_date')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('passport_no')->nullable();

            $table->date('passport_expiry_date')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('emergency_contact_name')->nullable();

            $table->string('emergency_contact_no')->nullable();
            $table->string('emergency_relationship')->nullable();
            $table->string('emergency_address')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('branch_id')->nullable();
            $table->integer('teacher_categories_id')->nullable();
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
        Schema::dropIfExists('teachers');
    }
};

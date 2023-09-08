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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); 

            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('login_status')->default(0);
            $table->rememberToken();


            $table->integer('user_id')->nullable();
            $table->string('personal_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('mobil');
            $table->string('personal_email');
            $table->string('gender');
            $table->string('religion');
            $table->string('nationality');
            $table->integer('division_id');
            $table->integer('district_id');
            $table->integer('city_id');
            $table->string('upazila');
            $table->string('post_office');
            $table->string('address');

            $table->string('institute_name');
            $table->string('institute_name_bangla');
            $table->string('institute_mobil');
            $table->string('institute_email');
            $table->string('institute_facebook');
            $table->string('account_type');
            $table->string('number_institute');
            $table->string('institute_age');
            $table->integer('institute_division_id');
            $table->integer('institute_district_id');
            $table->integer('institute_city_id');
            $table->string('institute_upazila');
            $table->string('institute_post_office');
            $table->string('institute_address');

            $table->string('profile')->nullable();
            $table->string('nid')->nullable();
            $table->string('trade_license')->nullable();
            $table->string('signature')->nullable();

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
        Schema::dropIfExists('branches');
    }
};

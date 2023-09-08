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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();
            $table->tinyInteger('attendance_status')->default(1);
            $table->unsignedBigInteger('stu_details_id');
            $table->date('attendance_date');
            $table->time('in_time')->nullable();
            $table->time('out_time')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('attendances');
    }
};

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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();
            $table->string('name');
            $table->string('initial_name');
            $table->string('department');
            $table->string('designation');
            $table->string('email');
            $table->string('phon_number');
            $table->string('room_no');
            $table->string('emergency_number');
            $table->text('profile_image');
            $table->tinyInteger('status');

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
        Schema::dropIfExists('employees');
    }
};

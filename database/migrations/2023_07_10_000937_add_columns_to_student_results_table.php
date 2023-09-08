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
        Schema::table('student_results', function (Blueprint $table) {
            $table->date("issue_date")->after("date")->nullable();
            $table->date("held_from")->after("date")->nullable();
            $table->date("held_to")->after("date")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_results', function (Blueprint $table) {
            //
        });
    }
};

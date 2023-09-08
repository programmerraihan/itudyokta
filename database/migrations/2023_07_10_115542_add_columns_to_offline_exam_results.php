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
        Schema::table('offline_exam_results', function (Blueprint $table) {
            $table->date("issue_date")->nullable()->after("status");
            $table->date("held_from")->nullable()->after("status");
            $table->date("held_to")->nullable()->after("status");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offline_exam_results', function (Blueprint $table) {
            //
        });
    }
};

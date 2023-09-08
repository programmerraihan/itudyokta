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
        Schema::create('assessment_question_masters', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('hour')->nullable();
            $table->integer('minute')->nullable();
            $table->double('total_marks');
            $table->longText('passege')->nullable();
            $table->integer('exam_id');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('branch_id')->nullable();
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
        Schema::dropIfExists('assessment_question_masters');
    }
};

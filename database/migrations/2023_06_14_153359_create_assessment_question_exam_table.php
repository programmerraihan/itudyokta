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
        Schema::create('assessment_question_exam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_questio_id')->constrained('assessment_question_masters', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('exam_id')->constrained('assessment_exams', 'id')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('assessment_question_exam');
    }
};

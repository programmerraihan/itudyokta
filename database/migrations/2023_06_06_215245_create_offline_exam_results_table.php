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
        Schema::create('offline_exam_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->foreignId('enrollment_id');
            $table->json('marks')->default('[]');
            $table->double('total', 8, 2);
            $table->float('cgpa');
            $table->char('grade', 3);
            $table->enum('status', ['pending', 'approved', 'reject'])->default('pending')->index();
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
        Schema::dropIfExists('offline_exam_results');
    }
};

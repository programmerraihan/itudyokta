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
        Schema::create('course_commissions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('method', ['cash', 'uddoktapay'])->default('cash');
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('course_title_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('student_id');
            $table->double('amount');
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
        Schema::dropIfExists('course_commissions');
    }
};

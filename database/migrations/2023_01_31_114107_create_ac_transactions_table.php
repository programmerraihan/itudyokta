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
        Schema::create('ac_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('memo_no');
            $table->integer('branch_id')->nullable();
            $table->string('voucher_no')->nullable();
            $table->unsignedBigInteger('ac_head_id')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->unsignedBigInteger('fund_id');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->date('fee_date')->nullable();
            $table->date('trans_date')->nullable();
            $table->integer('amount');
            $table->string('note')->nullable();
            $table->tinyInteger('entry_type')
                ->comment('1 for student income,2 for expense, 3 for other income')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('expense_person')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('ac_transactions');
    }
};

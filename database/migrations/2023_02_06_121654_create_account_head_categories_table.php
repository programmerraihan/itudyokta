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
        Schema::create('account_head_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_head_type_id');
            $table->string('name');
            $table->string('details')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('account_head_categories');
    }
};

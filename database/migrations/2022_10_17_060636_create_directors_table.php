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
        Schema::create('directors', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();

            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->string('designation')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();

            $table->tinyInteger('director_type')->nullable();

            $table->tinyInteger('status')->nullable();

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
        Schema::dropIfExists('directors');
    }
};

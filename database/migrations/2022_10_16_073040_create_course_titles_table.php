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
        Schema::create('course_titles', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();
            $table->integer('category_id');
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('offer_price')->nullable();


            $table->string('video_duration')->nullable();
            $table->string('total_video')->nullable();
            $table->string('course_link')->nullable();
            $table->longText('course_detail')->nullable();

            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();




            $table->tinyInteger('course_type')->nullable();


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
        Schema::dropIfExists('course_titles');
    }
};

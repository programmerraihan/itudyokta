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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('title')->nullable();
            $table->longText('body')->nullable();
            $table->longText('sort')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->unique()->nullable();

            $table->longText('blog_detail')->nullable();

            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();

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
        Schema::dropIfExists('blogs');
    }
};

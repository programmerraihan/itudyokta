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
        Schema::create('our_projects', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();

            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();

            $table->longText('project_detail')->nullable();

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
        Schema::dropIfExists('our_projects');
    }
};

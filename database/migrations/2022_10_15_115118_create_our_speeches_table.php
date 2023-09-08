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
        Schema::create('our_speeches', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();
            $table->string('title')->nullable();
            $table->longText('long_text')->nullable();
            $table->Text('sort_text')->nullable();
            $table->string('image')->nullable();
            $table->string('link_image')->nullable();
            $table->string('video_url')->nullable();
            $table->tinyInteger('status')->default('0')->nullable();
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
        Schema::dropIfExists('our_speeches');
    }
};

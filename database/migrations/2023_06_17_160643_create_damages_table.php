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
        Schema::create('damages', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId("asset_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->double('quantity', 8, 2);
            $table->double('damage_price', 8, 2);
            $table->double('total_damage_price', 8, 2);
            $table->foreignId('branch_id')->nullable();
            $table->enum('owner', ['admin', 'branch']);
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
        Schema::dropIfExists('damages');
    }
};

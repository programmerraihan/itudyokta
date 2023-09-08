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
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sale_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("product_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("unit_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->double("unit_price", 8, 2);
            $table->double("quantity", 8, 2);
            $table->double("discount", 8, 2);
            $table->double("amount", 8, 2);
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
        Schema::dropIfExists('sale_items');
    }
};

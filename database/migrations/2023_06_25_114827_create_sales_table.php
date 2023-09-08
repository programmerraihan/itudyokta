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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->char("reference_no")->index();
            $table->foreignId("branch_id")->nullable()->constrained('branches')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("customer", 125);
            $table->string("phone")->nullable();
            $table->double("quantity", 8, 2);
            $table->double("amount", 8, 2);
            $table->double("discount_amount", 8, 2);
            $table->double("grand_total", 8, 2);
            $table->tinyText("note")->nullable();
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
        Schema::dropIfExists('sales');
    }
};

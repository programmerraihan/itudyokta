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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('name');
            $table->string('supplier_name');
            $table->double('quantity', 8, 2);
            $table->double('purchase_price', 8, 2);
            $table->double('total_purchase_price', 8, 2);
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
        Schema::dropIfExists('assets');
    }
};

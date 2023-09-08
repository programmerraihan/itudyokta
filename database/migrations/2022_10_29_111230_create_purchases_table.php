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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();
            $table->string('challan_number');
            $table->string('recipient_name');
            $table->text('purchase_date');
            $table->string('phone_number');
            // $table->text('purchases_timestamp');

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();


            $table->text('note');

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
        Schema::dropIfExists('purchases');
    }
};

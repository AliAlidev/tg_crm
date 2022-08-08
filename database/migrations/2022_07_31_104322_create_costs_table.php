<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->id();
            $table->float('furniture_total')->default(0.0);
            $table->float('design_fee')->default(0.0); // 15 % of furniture total
            $table->float('total_amount')->default(0.0);
            $table->float('vat_fee')->default(0.0); // 5 % of total amount
            $table->float('installation_fees')->default(0.0);
            $table->float('grand_total')->default(0.0);
            $table->float('actual_total')->default(0.0);
            $table->foreignId('material_and_furniture_proposals_id');
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
        Schema::dropIfExists('costs');
    }
}

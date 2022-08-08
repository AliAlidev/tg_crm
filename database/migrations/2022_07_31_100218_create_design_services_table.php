<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->text('stage_a');
            $table->text('stage_b');
            $table->text('stage_c');
            $table->text('stage_d');
            $table->float('Subtotal')->default(0.0);
            $table->float('vat')->default(0.0);  // value equal 5 % of Subtotal
            $table->float('grand_total')->default(0.0);
            $table->boolean('is_paid')->default(false);
            $table->string('payment_date');
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
        Schema::dropIfExists('design_services');
    }
}

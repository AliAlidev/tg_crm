<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchitectureTaxInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('architecture_tax_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('date');
            $table->text('terms_and_conditions');
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
        Schema::dropIfExists('architecture_tax_invoices');
    }
}

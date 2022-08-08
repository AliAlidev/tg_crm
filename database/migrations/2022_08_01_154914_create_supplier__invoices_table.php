<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier__invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->integer('supplier_id');
            $table->string('path');
            $table->string('number');
            $table->integer('advanced_payment');
            $table->boolean('is_delivered')->default('0');
            $table->integer('total_payment');
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
        Schema::dropIfExists('supplier__invoices');
    }
}

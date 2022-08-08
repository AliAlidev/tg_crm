<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_date')->nullable();
            $table->string('Property')->nullable();
            $table->string('name_of_guest')->nullable();
            $table->string('accommodation_charge')->nullable();
            $table->string('security_deposit')->nullable();
            $table->string('date_of_stay')->nullable();
            $table->integer('number_of_days')->nullable();
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
        Schema::dropIfExists('contracts');
    }
}

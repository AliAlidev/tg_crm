<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            // $table->renameColumn('status','plot_number');
            $table->dropColumn('status');
            $table->dropColumn('price');
            $table->dropColumn('buyer_id');
            $table->dropColumn('payments');
            $table->string('plot_number')->nullable();
            $table->string('p_number')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('secondary_mobile')->nullable();
            $table->string('nationality')->nullable();
            $table->string('building_name')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('flat_number')->nullable();
            $table->boolean('balcony')->nullable();
            $table->string('parking_number')->nullable();
            $table->boolean('common_area')->default();
            $table->string('floor')->nullable();
            $table->integer('rooms')->nullable();
            $table->integer('levels')->nullable();
            $table->integer('shops')->nullable();
            $table->integer('flats')->nullable();
            $table->integer('offices')->nullable();
            $table->integer('age')->nullable();
            $table->string('municipality_number')->nullable();
            $table->string('master_project')->nullable();
            $table->string('project')->nullable();
            $table->string('property_type')->nullable();
            $table->string('type')->nullable();
            $table->string('villa_number')->nullable();
            $table->double('actual_area')->nullable();
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('Properties');
    }
}

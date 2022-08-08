<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialAndFurnitureListRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_and_furniture_list_rows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_and_furniture_list_row_id');
            $table->string('s_no')->nullable(true);
            $table->string('item_category')->nullable(true);
            $table->string('size')->nullable(true);
            $table->text('material_description')->nullable(true);
            $table->string('photo')->nullable(true);
            $table->string('unit')->nullable(true);
            $table->integer('qty')->nullable(true);
            $table->string('currency')->nullable(true);
            $table->float('unit_price')->default(0.0);
            $table->float('total_price')->default(0.0);
            $table->string('brands')->nullable(true);
            $table->boolean('delivery_status')->default(false);
            $table->float('actual_unit_price')->default(0.0);
            $table->float('actual_total_price')->default(0.0);
            $table->string('website_links')->nullable(true);
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
        Schema::dropIfExists('material_and_furniture_list_rows');
    }
}

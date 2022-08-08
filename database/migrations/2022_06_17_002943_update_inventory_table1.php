<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInventoryTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn('developer');
            $table->dropColumn('community_location');
            $table->dropColumn('building_name');
            $table->dropColumn('property_name');
            $table->dropColumn('unit_number');
            $table->dropColumn('plot_area');
            $table->dropColumn('customer_name');
            $table->dropColumn('email_address');
            $table->dropColumn('mobile');
            $table->dropColumn('comments');
            $table->dropColumn('nationality');
            $table->dropColumn('property_type');
            $table->dropColumn('furniture');
            $table->dropColumn('floor_plans_view');
            $table->dropColumn('bedrooms');
            $table->dropColumn('customer_type');
            $table->dropColumn('can_add');
            $table->dropColumn('unite_price');
            $table->dropColumn('roi');
            $table->dropColumn('telephone_number');
            $table->dropColumn('telephone_residence');
            $table->dropColumn('telephone_office');
            $table->dropColumn('general');
            $table->dropColumn('property_finder_link');
            $table->dropColumn('buyut_link');
            $table->dropColumn('dubizzle_link');
            $table->dropColumn('wow_propties_link');
            $table->dropColumn('status');
            $table->dropColumn('serial_num');
            $table->dropColumn('other_links');
            $table->dropColumn('type_of_apt');
            $table->dropColumn('property_size');
            $table->dropColumn('floors');
            $table->dropColumn('service_charge');
            $table->dropColumn('payment_plan');
            $table->dropColumn('rent');
            $table->dropColumn('ready_off');
            $table->dropColumn('handover');
            $table->dropColumn('price_aed');
            $table->dropColumn('bathrooms');
            $table->dropColumn('completion');
            $table->dropColumn('date_listed');
            $table->dropColumn('agent_name');
            $table->dropColumn('category');
            $table->dropColumn('building_status');
            $table->dropColumn('unit_for_sales');
            $table->dropColumn('remarks');
            $table->dropColumn('source_of_lead');
            $table->dropColumn('specifications');
            // $table->string('client_name')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('country')->nullable();
            $table->string('date')->nullable();
            $table->string('LPONO')->nullable();
            $table->string('description')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

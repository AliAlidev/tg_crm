<?php

namespace Database\Seeders;

use App\Models\default_value;
use Illuminate\Database\Seeder;

class DefaultValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        default_value::updateOrCreate(
            ['name' => 'stage_a'],
            [
                'name' => 'stage_a',
                'value' => 'Null'
            ]);
        default_value::updateOrCreate(
            ['name' => 'stage_b'],
            [
                'name' => 'stage_b',
                'value' => 'Developing design drawings and full furniture plans.
                Developing detail drawings(if any)with exact measurments,material selction,and colors.
                Detailed specification of finishing materials.
                Proposing full furniture selection, as well as lighting ,carpets,curtains.
                Preparation of the furniture Bill Of Quantities with materials,size,description,and full price estimation.
                Supervise work in the apartment if necessary - including painting of walls,installation of wallpaper,etc'
            ]);
        default_value::updateOrCreate(
            ['name' => 'stage_c'],
            [
                'name' => 'stage_c',
                'value' => 'Market research for the right products and finishing\'s to be used in the project.
                Sourcing of furniture.
                Sourcing of lighting and artwork.
                Sourcing of carpets and curtains.
                Sourcing of decoration and accessories.
                Accessorizing,sourcing and styling of the villa including tableware,bed sheets,towels,textiles,decorations,and accessories,
                Negotiate prices with suppliers to get the best deals'
            ]);
        default_value::updateOrCreate(
            ['name' => 'stage_d'],
            [
                'name' => 'stage_d',
                'value' => 'Site supervision starting from the time of interior finishing fit-out work period.
                Supervision and quality control on site and furniture factories.
                Weekly supervision by interior designer to manage project progress.
                Meeting and following up with suppliers.
                Managing deliveries,installation and styling.
                Product controlling and snagging till handover to client'
            ]);

    }
}

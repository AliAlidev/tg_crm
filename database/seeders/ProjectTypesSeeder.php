<?php

namespace Database\Seeders;

use App\Models\ProjectType;
use Illuminate\Database\Seeder;

class ProjectTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectType::firstOrCreate(['name'=>'Architecture'],['name'=>'Architecture']);
        ProjectType::firstOrCreate(['name'=>'Civil'],['name'=>'Civil']);
    }
}

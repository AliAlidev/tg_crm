<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(['name' => 'admin'], ['name' => 'admin', 'role_id' => 1]);
        Role::firstOrCreate(['name' => 'consultant'], ['name' => 'consultant', 'role_id' => 2]);
        Role::firstOrCreate(['name' => 'agent'], ['name' => 'agent', 'role_id' => 3]);
        Role::firstOrCreate(['name' => 'buyer'], ['name' => 'buyer', 'role_id' => 4]);
        Role::firstOrCreate(['name' => 'accountant'], ['name' => 'accountant', 'role_id' => 5]);
        Role::firstOrCreate(['name' => 'designer'], ['name' => 'designer', 'role_id' => 6]);
        Role::firstOrCreate(['name' => 'operation_manager'], ['name' => 'operation_manager', 'role_id' => 7]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'investor']);
        Role::create(['name' => 'merchant']);
        Role::create(['name' => 'bod']);
        Role::create(['name' => 'webmaster']);
        Role::create(['name' => 'admin']);
    }
}

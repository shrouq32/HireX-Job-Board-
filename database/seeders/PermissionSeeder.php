<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::factory()->create(['name' => 'admin']);
        Permission::factory()->create(['name' => 'employer']);
        Permission::factory()->create(['name' => 'candidate']);
    }
}

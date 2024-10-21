<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApplicationStatus;

class ApplicationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApplicationStatus::factory()->create(['name' => 'pending']);
        ApplicationStatus::factory()->create(['name' => 'rejected']);
        ApplicationStatus::factory()->create(['name' => 'accepted']);
    }
}

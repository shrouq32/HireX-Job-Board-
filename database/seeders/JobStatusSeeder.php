<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobStatus;

class JobStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobStatus::factory()->create(['name' => 'pending']);
        JobStatus::factory()->create(['name' => 'rejected']);
        JobStatus::factory()->create(['name' => 'accepted']);
    }
}

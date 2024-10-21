<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->create(['name' => 'Engineering']);
        Category::factory()->create(['name' => 'Marketing']);
        Category::factory()->create(['name' => 'Design']);
        Category::factory()->create(['name' => 'Finance']);
        Category::factory()->create(['name' => 'Human Resources']);
        Category::factory()->create(['name' => 'Sales']);
        Category::factory()->create(['name' => 'Customer Service']);
        Category::factory()->create(['name' => 'Quality Assurance']);
    }
}

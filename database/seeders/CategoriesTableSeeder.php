<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'PHP']);
        Category::create(['name' => 'Laravel']);
        Category::create(['name' => 'HTML']);
        Category::create(['name' => 'Javascript']);
        Category::create(['name' => 'Node']);
        Category::create(['name' => 'React']);
    }
}

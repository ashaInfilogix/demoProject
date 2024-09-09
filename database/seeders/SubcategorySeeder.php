<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subcategory;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [
            ['name' => 'Mobile Phones', 'category_id' => 1],
            ['name' => 'Laptops', 'category_id' => 1],
            ['name' => 'Fiction', 'category_id' => 2],
            ['name' => 'Non-Fiction', 'category_id' => 2],
            ['name' => 'Men\'s Clothing', 'category_id' => 3],
            ['name' => 'Women\'s Clothing', 'category_id' => 3],
        ];

        foreach ($subcategories as $subcategory) {
            Subcategory::create($subcategory);
        }
    }
}

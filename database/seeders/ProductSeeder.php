<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'iPhone 14', 'subcategory_id' => 1, 'price' => 999.99],
            ['name' => 'Samsung Galaxy S23', 'subcategory_id' => 1, 'price' => 849.99],
            ['name' => 'MacBook Pro', 'subcategory_id' => 2, 'price' => 1999.99],
            ['name' => 'Dell XPS 13', 'subcategory_id' => 2, 'price' => 1299.99],
            ['name' => 'The Great Gatsby', 'subcategory_id' => 3, 'price' => 10.99],
            ['name' => 'Sapiens: A Brief History of Humankind', 'subcategory_id' => 4, 'price' => 14.99],
            ['name' => 'Men\'s Slim Fit Shirt', 'subcategory_id' => 5, 'price' => 29.99],
            ['name' => 'Women\'s Summer Dress', 'subcategory_id' => 6, 'price' => 49.99],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

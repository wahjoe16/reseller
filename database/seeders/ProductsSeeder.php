<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // sample category
        $sepatu = Category::create(['title' => 'Sepatu', 'parent_id' => 0]);
        $sepatu->childs()->saveMany([
            new Category(['title' => 'Lifestyle']),
            new Category(['title' => 'Berlari']),
            new Category(['title' => 'Basket']),
            new Category(['title' => 'Sepakbola'])
        ]);
        $pakaian = Category::create(['title' => 'Pakaian', 'parent_id' => 0]);
        $pakaian->childs()->saveMany([
            new Category(['title' => 'Jaket']),
            new Category(['title' => 'Hoodie']),
            new Category(['title' => 'Rompi']),
        ]);

        // sample product
        $running = Category::where('title', 'Berlari')->first();
        $lifestyle = Category::where('title', 'Lifestyle')->first();
        $sepatu1 = Product::create([
            'name' => 'Nike Air Force',
            'model' => 'Sepatu Pria',
            'photo' => 'stub-shoe.jpg',
            'price' => 340000
        ]);
        $sepatu2 = Product::create([
            'name' => 'Nike Air Max',
            'model' => 'Sepatu Wanita',
            'photo' => 'stub-shoe.jpg',
            'price' => 420000
        ]);
        $sepatu3 = Product::create([
            'name' => 'Nike Air Zoom',
            'model' => 'Sepatu Wanita',
            'photo' => 'stub-shoe.jpg',
            'price' => 360000
        ]);
        $running->products()->saveMany([$sepatu1, $sepatu2, $sepatu3]);
        $lifestyle->products()->saveMany([$sepatu1, $sepatu2]);
        $jacket = Category::where('title', 'Jaket')->first();
        $vest = Category::where('title', 'Rompi')->first();
        $jacket1 = Product::create([
            'name' => 'Nike Aeroloft Bomber',
            'model' => 'Jaket Wanita',
            'photo' => 'stub-jacket.jpg',
            'price' => 720000
        ]);
        $jacket2 = Product::create([
            'name' => 'Nike Guild 550',
            'model' => 'Jaket Pria',
            'photo' => 'stub-jacket.jpg',
            'price' => 380000
        ]);
        $jacket3 = Product::create([
            'name' => 'Nike SB Steele',
            'model' => 'Jaket Pria',
            'photo' => 'stub-jacket.jpg',
            'price' => 1200000
        ]);
        $jacket->products()->saveMany([$jacket1, $jacket3]);
        $vest->products()->saveMany([$jacket2, $jacket3]);
    }
}

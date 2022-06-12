<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(3)->create();
        
        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => 'admin',
        //     'is_admin' => 1
        // ]);

        // User::create([
        //     'name' => 'Abdhan Qardhawi',
        //     'email' => 'abdan@gmail.com',
        //     'password' => 'ffff',
        // ]);

        User::factory(3)->create();

        Category::create([
            'name' => 'Coffee Beans',
            'slug' => 'coffee-beans',
            'description' => 'Kategori coffee-beans',
        ]);

        Category::create([
            'name' => 'Tea',
            'slug' => 'tea',
            'description' => 'Kategori tea',
        ]);

        Category::factory(1)->create();

        // Product::factory(15)->create();

        Product::create([
            'name' => 'Gayo Coffee Beans',
            'slug' => 'gayo-coffee-beans',
            'category_id' => 1,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Molestie nunc non blandit massa enim nec dui nunc mattis.',
            // 'original_price' => 60000,
            'selling_price' => 200000,
            'qty' => 12,
        ]);
        Product::create([
            'name' => 'Luwak Coffee Beans',
            'slug' => 'luwak-coffee-beans',
            'category_id' => 1,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Molestie nunc non blandit massa enim nec dui nunc mattis.',
            'original_price' => 200000,
            'selling_price' => 180000,
            'qty' => 19,
        ]);
        Product::create([
            'name' => 'Toraja Coffee Beans',
            'slug' => 'toraja-coffee-beans',
            'category_id' => 1,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Molestie nunc non blandit massa enim nec dui nunc mattis.',
            'original_price' => 60000,
            'selling_price' => 50000,
            'qty' => 22,
        ]);
        Product::create([
            'name' => 'Java Tea',
            'slug' => 'java-tea',
            'category_id' => 2,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Molestie nunc non blandit massa enim nec dui nunc mattis.',
            // 'original_price' => 60000,
            'selling_price' => 45000,
            'qty' => 30,
        ]);
        Product::create([
            'name' => 'Herbal Tea',
            'slug' => 'herbal-tea',
            'category_id' => 2,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Molestie nunc non blandit massa enim nec dui nunc mattis.',
            'original_price' => 55000,
            'selling_price' => 50000,
            'qty' => 22,
        ]);
        Product::create([
            'name' => 'Green Tea',
            'slug' => 'green-tea',
            'category_id' => 2,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Molestie nunc non blandit massa enim nec dui nunc mattis.',
            // 'original_price' => 60000,
            'selling_price' => 20000,
            'qty' => 52,
        ]);
    }
}

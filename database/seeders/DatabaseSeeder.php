<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Inventory\Entities\Inventory;
use Modules\Order\Entities\Bank;
use Modules\Order\Entities\Payment;
use Modules\Order\Entities\Shipping;
use Modules\Order\Entities\Store;
use Modules\Product\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Type;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() : void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => '123',
            'is_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'Client',
            'email' => 'client@example.com',
            'password' => '123',
        ]);

        Type::create([
            'id' => 1,
            'name' => 'Clothes',
            'slug' => 'clothes',
        ]);

        Category::create([
            'category_id' => 1,
            'name' => 'Uncategorized',
            'slug' => 'uncategorized',
        ]);

        Product::create([
            'id' => 1,
            'type_id' => 1,
            'name' => 'Product 1',
            'slug' => 'product-1',
            'summary' => 'fake data',
            'detail' => 'fake data',
            'category_id' => '1',
            'regular_price' => 500.00,
            'sale_price' => 450.00,
        ]);

        Inventory::create([
            'product_id' => 1,
            'quantity' => 100,
        ]);

        Shipping::create([
            'name' => 'express',
            'price' => 33000,
        ]);

        Shipping::create([
            'name' => 'saving',
            'price' => 18000,
        ]);

        Shipping::create([
            'name' => 'fast',
            'price' => 22000,
        ]);
    }
}

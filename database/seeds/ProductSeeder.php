<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'barcode' => 1,
            'name' => 'tombak moskov',
            'stock' => 100,
            'category_id' => 1,
            'harga_beli' => 200,
            'harga_jual' => 500,
        ]);
        Product::create([
            'barcode' => 3,
            'name' => 'tombak alucard',
            'stock' => 100,
            'category_id' => 1,
            'harga_beli' => 200,
            'harga_jual' => 500,
        ]);
        Product::create([
            'barcode' => 2,
            'name' => 'tombak layla',
            'category_id' => 1,
            'stock' => 100,
            'harga_beli' => 200,
            'harga_jual' => 500,
        ]);

    }
}

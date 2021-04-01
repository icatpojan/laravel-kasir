<?php

use App\Model\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::create([
            'name' => 'islah',
            'address' => 'bandung barat',
            'phone_number' => 12345,
        ]);
    }
}

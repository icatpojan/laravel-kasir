<?php

use App\Model\Keuangan;
use Illuminate\Database\Seeder;

class KeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Keuangan::create([
            'keterangan' => 'dana dari pablo escobar',
            'debit' => 1000000,
            'saldo' => 1000000,
        ]);
    }
}

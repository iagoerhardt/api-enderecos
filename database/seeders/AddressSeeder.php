<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Address;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            'city' => 'São Paulo',
            'state' => 'SP',
            'street' => 'Avenida 9 de Julho',
            'number' => '123',
            'complement' => 'Apto. 101',
            'zip_code' => '01001-000',
            'neighborhood' => 'Centro'
        ]);
    }
}

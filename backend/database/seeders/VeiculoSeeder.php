<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Veiculo;

class VeiculoSeeder extends Seeder
{
    public function run(): void
    {
        Veiculo::insert([
            ['placa' => 'ABC-1234', 'modelo' => 'Fiat Uno 2015', 'created_at' => now(), 'updated_at' => now()],
            ['placa' => 'XYZ-9876', 'modelo' => 'Chevrolet Onix 2020', 'created_at' => now(), 'updated_at' => now()],
            ['placa' => 'JKL-4567', 'modelo' => 'Volkswagen Gol 2018', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

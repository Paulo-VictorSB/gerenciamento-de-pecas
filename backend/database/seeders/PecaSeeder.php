<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peca;

class PecaSeeder extends Seeder
{
    public function run(): void
    {
        Peca::insert([
            [
                'veiculo_id' => 1,
                'fornecedor_id' => 1,
                'nome' => 'Filtro de Ar',
                'data_compra' => '2025-10-15',
                'data_previsao' => '2025-10-20',
                'data_chegada' => '2025-10-19',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'veiculo_id' => 1,
                'fornecedor_id' => 2,
                'nome' => 'Pastilha de Freio',
                'data_compra' => '2025-10-17',
                'data_previsao' => '2025-10-25',
                'data_chegada' => '2025-10-24',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'veiculo_id' => 2,
                'fornecedor_id' => 3,
                'nome' => 'Correia Dentada',
                'data_compra' => '2025-11-01',
                'data_previsao' => '2025-11-08',
                'data_chegada' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

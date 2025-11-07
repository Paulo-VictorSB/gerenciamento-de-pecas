<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fornecedor;

class FornecedorSeeder extends Seeder
{
    public function run(): void
    {
        Fornecedor::insert([
            ['nome' => 'Auto Peças Silva', 'cnpj' => '12.345.678/0001-99', 'telefone' => '(11) 99999-1111', 'email' => 'contato@autossilva.com', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Peças Rápidas Ltda', 'cnpj' => '23.456.789/0001-88', 'telefone' => '(11) 98888-2222', 'email' => 'vendas@pecasrapidas.com', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Distribuidora Mecânica Pro', 'cnpj' => '34.567.890/0001-77', 'telefone' => '(21) 97777-3333', 'email' => 'atendimento@mecanicapro.com', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pecas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('veiculo_id')->constrained('veiculos')->onDelete('cascade');
            $table->foreignId('fornecedor_id')->nullable()->constrained('fornecedores')->onDelete('set null');
            $table->string('nome', 100);
            $table->date('data_compra')->nullable();
            $table->date('data_previsao')->nullable();
            $table->date('data_chegada')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pecas');
    }
};

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peca extends Model
{
    use HasFactory;

    protected $fillable = [
        'veiculo_id',
        'fornecedor_id',
        'nome',
        'data_compra',
        'data_previsao',
        'data_chegada'
    ];

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}

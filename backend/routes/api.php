<?php

use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\PecaController;
use App\Http\Controllers\VeiculoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('fornecedor', FornecedorController::class);
Route::apiResource('peca', PecaController::class);
Route::apiResource('veiculo', VeiculoController::class);

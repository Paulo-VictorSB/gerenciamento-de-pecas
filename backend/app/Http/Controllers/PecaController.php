<?php

namespace App\Http\Controllers;

use App\Models\Peca;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PecaController extends Controller
{
    public function index()
    {
        $pecas = Peca::with(['veiculo', 'fornecedor'])
            ->orderByDesc('data_compra')
            ->paginate(10);

        if ($pecas->isEmpty()) {
            $this->data['success'] = false;
            $this->data['message'] = 'Nenhuma peça encontrada.';
            return $this->respond(404);
        }

        $this->data['data'] = $pecas;
        return $this->respond(200);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate(
                [
                    'veiculo_id' => 'required|exists:veiculos,id',
                    'fornecedor_id' => 'nullable|exists:fornecedores,id',
                    'nome' => 'required|string|max:100',
                    'data_compra' => 'nullable|date',
                    'data_previsao' => 'nullable|date',
                    'data_chegada' => 'nullable|date',
                ],
                [
                    'veiculo_id.required' => 'O campo veículo é obrigatório.',
                    'veiculo_id.exists' => 'O veículo informado não existe.',
                    'fornecedor_id.exists' => 'O fornecedor informado não existe.',
                    'nome.required' => 'O campo nome é obrigatório.',
                    'nome.max' => 'O nome não pode ultrapassar 100 caracteres.',
                    'data_compra.date' => 'A data de compra deve ser uma data válida.',
                    'data_previsao.date' => 'A data de previsão deve ser uma data válida.',
                    'data_chegada.date' => 'A data de chegada deve ser uma data válida.',
                ]
            );

            $peca = Peca::create($validated);

            $this->data['message'] = 'Peça cadastrada com sucesso.';
            $this->data['data'] = $peca;

            return $this->respond(201);
        } catch (ValidationException $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro de validação.';
            $this->data['data'] = $e->errors();

            return $this->respond(422);
        } catch (\Exception $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro ao cadastrar a peça.';
            $this->data['data'] = ['error' => $e->getMessage()];

            return $this->respond(500);
        }
    }

    public function show(string $id)
    {
        try {
            $peca = Peca::with(['veiculo', 'fornecedor'])->findOrFail($id);

            $this->data['message'] = 'Peça encontrada com sucesso.';
            $this->data['data'] = $peca;

            return $this->respond(200);
        } catch (ModelNotFoundException $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Peça não encontrada.';
            return $this->respond(404);
        } catch (\Exception $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro ao buscar a peça.';
            $this->data['data'] = ['error' => $e->getMessage()];
            return $this->respond(500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $peca = Peca::findOrFail($id);

            $validated = $request->validate(
                [
                    'veiculo_id' => 'required|exists:veiculos,id',
                    'fornecedor_id' => 'nullable|exists:fornecedores,id',
                    'nome' => 'required|string|max:100',
                    'data_compra' => 'nullable|date',
                    'data_previsao' => 'nullable|date',
                    'data_chegada' => 'nullable|date',
                ],
                [
                    'veiculo_id.required' => 'O campo veículo é obrigatório.',
                    'veiculo_id.exists' => 'O veículo informado não existe.',
                    'fornecedor_id.exists' => 'O fornecedor informado não existe.',
                    'nome.required' => 'O campo nome é obrigatório.',
                    'nome.max' => 'O nome não pode ultrapassar 100 caracteres.',
                    'data_compra.date' => 'A data de compra deve ser uma data válida.',
                    'data_previsao.date' => 'A data de previsão deve ser uma data válida.',
                    'data_chegada.date' => 'A data de chegada deve ser uma data válida.',
                ]
            );

            $peca->update($validated);

            $this->data['message'] = 'Peça atualizada com sucesso.';
            $this->data['data'] = $peca;

            return $this->respond(200);
        } catch (ValidationException $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro de validação.';
            $this->data['data'] = $e->errors();

            return $this->respond(422);
        } catch (ModelNotFoundException $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Peça não encontrada.';
            return $this->respond(404);
        } catch (\Exception $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro ao atualizar a peça.';
            $this->data['data'] = ['error' => $e->getMessage()];
            return $this->respond(500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $peca = Peca::findOrFail($id);
            $peca->delete();

            $this->data['message'] = 'Peça excluída com sucesso.';
            $this->data['data'] = ['id' => $id];

            return $this->respond(200);
        } catch (ModelNotFoundException $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Peça não encontrada.';
            return $this->respond(404);
        } catch (\Exception $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro ao excluir a peça.';
            $this->data['data'] = ['error' => $e->getMessage()];
            return $this->respond(500);
        }
    }
}

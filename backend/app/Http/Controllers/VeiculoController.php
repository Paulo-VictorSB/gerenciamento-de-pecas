<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VeiculoController extends Controller
{
    public function index()
    {
        $veiculos = Veiculo::with('pecas')
            ->orderByDesc('created_at')
            ->paginate(10);

        if ($veiculos->isEmpty()) {
            $this->data['success'] = false;
            $this->data['message'] = 'Nenhum veículo encontrado.';
            return $this->respond(404);
        }

        $this->data['data'] = $veiculos;
        return $this->respond(200);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate(
                [
                    'placa' => 'required|string|max:10|unique:veiculos,placa',
                    'modelo' => 'required|string|max:100',
                ],
                [
                    'placa.required' => 'O campo placa é obrigatório.',
                    'placa.max' => 'A placa não pode ultrapassar 10 caracteres.',
                    'placa.unique' => 'Já existe um veículo cadastrado com esta placa.',
                    'modelo.required' => 'O campo modelo é obrigatório.',
                    'modelo.max' => 'O modelo não pode ultrapassar 100 caracteres.',
                ]
            );

            $veiculo = Veiculo::create($validated);

            $this->data['message'] = 'Veículo cadastrado com sucesso.';
            $this->data['data'] = $veiculo;

            return $this->respond(201);
        } catch (ValidationException $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro de validação.';
            $this->data['data'] = $e->errors();

            return $this->respond(422);
        } catch (\Exception $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro ao cadastrar o veículo.';
            $this->data['data'] = ['error' => $e->getMessage()];

            return $this->respond(500);
        }
    }

    public function show(string $id)
    {
        try {
            $veiculo = Veiculo::with('pecas')->findOrFail($id);

            $this->data['message'] = 'Veículo encontrado com sucesso.';
            $this->data['data'] = $veiculo;

            return $this->respond(200);
        } catch (ModelNotFoundException $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Veículo não encontrado.';

            return $this->respond(404);
        } catch (\Exception $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro ao buscar o veículo.';
            $this->data['data'] = ['error' => $e->getMessage()];

            return $this->respond(500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $veiculo = Veiculo::findOrFail($id);

            $validated = $request->validate(
                [
                    'placa' => 'required|string|max:10|unique:veiculos,placa,' . $id,
                    'modelo' => 'required|string|max:100',
                ],
                [
                    'placa.required' => 'O campo placa é obrigatório.',
                    'placa.max' => 'A placa não pode ultrapassar 10 caracteres.',
                    'placa.unique' => 'Já existe um veículo cadastrado com esta placa.',
                    'modelo.required' => 'O campo modelo é obrigatório.',
                    'modelo.max' => 'O modelo não pode ultrapassar 100 caracteres.',
                ]
            );

            $veiculo->update($validated);

            $this->data['message'] = 'Veículo atualizado com sucesso.';
            $this->data['data'] = $veiculo;

            return $this->respond(200);
        } catch (ValidationException $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro de validação.';
            $this->data['data'] = $e->errors();

            return $this->respond(422);
        } catch (ModelNotFoundException $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Veículo não encontrado.';

            return $this->respond(404);
        } catch (\Exception $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro ao atualizar o veículo.';
            $this->data['data'] = ['error' => $e->getMessage()];

            return $this->respond(500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $veiculo = Veiculo::findOrFail($id);

            $veiculo->delete();

            $this->data['message'] = 'Veículo excluído com sucesso.';
            $this->data['data'] = ['id' => $id];

            return $this->respond(200);
        } catch (ModelNotFoundException $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Veículo não encontrado.';

            return $this->respond(404);
        } catch (\Exception $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro ao excluir o veículo.';
            $this->data['data'] = ['error' => $e->getMessage()];

            return $this->respond(500);
        }
    }
}

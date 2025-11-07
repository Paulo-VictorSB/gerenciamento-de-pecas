<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::orderByDesc('created_at')->paginate(10);

        if ($fornecedores->isEmpty()) {
            $this->data['success'] = false;
            $this->data['message'] = 'Nenhum fornecedor encontrado.';
            return $this->respond(404);
        }

        $this->data['data'] = $fornecedores;
        return $this->respond(200);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate(
                [
                    'nome' => 'required|string|max:100|unique:fornecedores,nome',
                    'cnpj' => 'nullable|string|max:18|unique:fornecedores,cnpj',
                    'telefone' => 'nullable|string|max:20|unique:fornecedores,telefone',
                    'email' => 'nullable|email|max:100|unique:fornecedores,email',
                ],
                [
                    'nome.required' => 'O campo nome é obrigatório.',
                    'nome.max' => 'O nome não pode ultrapassar 100 caracteres.',
                    'nome.unique' => 'Já existe um fornecedor com este nome.',
                    'email.email' => 'O e-mail informado não é válido.',
                    'email.max' => 'O e-mail não pode ultrapassar 100 caracteres.',
                    'email.unique' => 'Já existe um fornecedor com este e-mail.',
                    'cnpj.max' => 'O CNPJ não pode ultrapassar 18 caracteres.',
                    'cnpj.unique' => 'Já existe um fornecedor com este CNPJ.',
                    'telefone.max' => 'O telefone não pode ultrapassar 20 caracteres.',
                    'telefone.unique' => 'Já existe um fornecedor com este telefone.',
                ]
            );

            $fornecedor = Fornecedor::create($validated);

            $this->data['message'] = 'Fornecedor cadastrado com sucesso.';
            $this->data['data'] = $fornecedor;

            return $this->respond(201);
        } catch (ValidationException $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro de validação.';
            $this->data['data'] = $e->errors();

            return $this->respond(422);
        } catch (\Exception $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro ao cadastrar o fornecedor.';
            $this->data['data'] = ['error' => $e->getMessage()];

            return $this->respond(500);
        }
    }

    public function show(string $id)
    {
        try {
            $fornecedor = Fornecedor::findOrFail($id);

            $this->data['message'] = 'Fornecedor encontrado com sucesso.';
            $this->data['data'] = $fornecedor;

            return $this->respond(200);
        } catch (ModelNotFoundException $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Fornecedor não encontrado.';

            return $this->respond(404);
        } catch (\Exception $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro ao buscar fornecedor.';
            $this->data['data'] = ['error' => $e->getMessage()];

            return $this->respond(500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $fornecedor = Fornecedor::findOrFail($id);

            $validated = $request->validate(
                [
                    'nome' => 'required|string|max:100|unique:fornecedores,nome,' . $id,
                    'cnpj' => 'nullable|string|max:18|unique:fornecedores,cnpj,' . $id,
                    'telefone' => 'nullable|string|max:20|unique:fornecedores,telefone,' . $id,
                    'email' => 'nullable|email|max:100|unique:fornecedores,email,' . $id,
                ],
                [
                    'nome.required' => 'O campo nome é obrigatório.',
                    'nome.max' => 'O nome não pode ultrapassar 100 caracteres.',
                    'nome.unique' => 'Já existe um fornecedor com este nome.',
                    'email.email' => 'O e-mail informado não é válido.',
                    'email.max' => 'O e-mail não pode ultrapassar 100 caracteres.',
                    'email.unique' => 'Já existe um fornecedor com este e-mail.',
                    'cnpj.max' => 'O CNPJ não pode ultrapassar 18 caracteres.',
                    'cnpj.unique' => 'Já existe um fornecedor com este CNPJ.',
                    'telefone.max' => 'O telefone não pode ultrapassar 20 caracteres.',
                    'telefone.unique' => 'Já existe um fornecedor com este telefone.',
                ]
            );

            $fornecedor->update($validated);

            $this->data['message'] = 'Fornecedor atualizado com sucesso.';
            $this->data['data'] = $fornecedor;

            return $this->respond(200);
        } catch (ValidationException $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro de validação.';
            $this->data['data'] = $e->errors();

            return $this->respond(422);
        } catch (ModelNotFoundException $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Fornecedor não encontrado.';

            return $this->respond(404);
        } catch (\Exception $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro ao atualizar o fornecedor.';
            $this->data['data'] = ['error' => $e->getMessage()];

            return $this->respond(500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $fornecedor = Fornecedor::findOrFail($id);

            $fornecedor->delete();

            $this->data['message'] = 'Fornecedor excluído com sucesso.';
            $this->data['data'] = ['id' => $id];

            return $this->respond(200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Fornecedor não encontrado.';

            return $this->respond(404);
        } catch (\Exception $e) {
            $this->data['success'] = false;
            $this->data['message'] = 'Erro ao excluir o fornecedor.';
            $this->data['data'] = ['error' => $e->getMessage()];

            return $this->respond(500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutosController extends Controller
{
    public function create(){
        return view('produtos.create');
    }

    public function list(){
        $produtos = Produto::all();
        return view('produtos.list', ['produtos' => $produtos]);
    }

    public function store(Request $request){
        Produto::create([
            'nome' => $request->nome,
            'preco' => $request->preco,
            'codigo' => $request->codigo,
        ]);

        return "Produto criado com sucesso! <a href='/produtos/lista'>Voltar para a lista</a>";
    }

    public function edit($id){
        $produto = Produto::findOrFail($id);
        return view('produtos.edit', ['produto' => $produto]);
    }

    public function update(Request $request, $id){
        $produto = Produto::findOrFail($id);

        $produto->update([
            'nome' => $request->nome,
            'preco' => $request->preco,
            'codigo' => $request->codigo,
        ]);

        return "Produto atualizado com sucesso! <a href='/produtos/lista'>Voltar para a lista</a>";
    }

    public function delete($id){
        $produto = Produto::findOrFail($id);
        return view('produtos.delete', ['produto' => $produto]);
    }

    public function destroy($id){
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return "Produto excluído com sucesso! <a href='/produtos/lista'>Voltar para a lista</a>";
    }
}

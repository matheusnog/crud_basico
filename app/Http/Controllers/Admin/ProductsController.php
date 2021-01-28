<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function list()
    {
        $products = Product::all();
        return view('products.list', ['products' => $products]);
    }

    public function store(Request $request)
    {
        Product::create([
            'nome' => $request->nome,
            'preco' => $request->preco,
            'codigo' => $request->codigo,
        ]);

        return "Product criado com sucesso! <a href='/products/lista'>Voltar para a lista</a>";
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $Product = Product::findOrFail($id);

        $Product->update([
            'nome' => $request->nome,
            'preco' => $request->preco,
            'codigo' => $request->codigo,
        ]);

        return "Product atualizado com sucesso! <a href='/products/lista'>Voltar para a lista</a>";
    }

    public function delete($id)
    {
        $Product = Product::findOrFail($id);
        return view('products.delete', ['Product' => $Product]);
    }

    public function destroy($id)
    {
        $Product = Product::findOrFail($id);
        $Product->delete();

        return "Product excluído com sucesso! <a href='/products/lista'>Voltar para a lista</a>";
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show', ['product' => $product]);
    }

    public function showAll()
    {
        $product = Product::all();
        return view('products.all', ['product' => $product]);
    }

    public function showAll2()
    {
        $product = Product::all();
        return view('products.lista', ['product' => $product]);
    }
}

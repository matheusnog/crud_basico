<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutosController extends Controller
{
    public function getAll(){
        return Produto::all();
    }

    public function get($id){
        return Produto::find($id);
    }

    public function post(Request $request){
        $produto = new Produto();
        $produto->nome = $request->nome;
        $produto->preco = $request->preco;
        $produto->codigo = $request->codigo;
        $produto->save();

        return response()->json([
            'message'=>'Produto criado com sucesso!',
            'data'=>$produto],200);
    }
}

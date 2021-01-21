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

    public function delete($id){
        $produto = Produto::find($id);
        if(is_object($produto)){
            $produto->delete();
            return response()->json([
                'message'=>'Produto deletado com sucesso!',
                'data'=>$produto],200);
        }else{
            return response()->json([
                'message'=>'Não foi possível deletar o usuario!',
                'data'=>''],404);
        }
    }
}

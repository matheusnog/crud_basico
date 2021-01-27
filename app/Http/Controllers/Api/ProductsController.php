<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function getAll()
    {
        return Product::with('inputs.product', 'saleProducts.sale', 'saleProducts.product')->get()->toArray();
    }

    public function get($id)
    {
        return Product::where('id', '=', $id)->with('inputs', 'saleProducts.sale', 'saleProducts.product')->get()->toArray();
    }

    public function post(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->code = $request->code;
        $product->current_amount = 0;
        $product->save();

        return response()->json([
            'message' => 'Product criado com sucesso!',
            'data' => $product
        ], 200);
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (is_object($product)) {
            $product->delete();
            return response()->json([
                'message' => 'Product deletado com sucesso!',
                'data' => $product
            ], 200);
        } else {
            return response()->json([
                'message' => 'Não foi possível deletar o usuario!',
                'data' => ''
            ], 404);
        }
    }

    public function put($id, Request $request)
    {
        $product = Product::find($id);

        if (is_object($product)) {
            $product->name = $request->name;
            $product->code = $request->code;
            // $product->current_amount = $request->current_amount;

            $product->save();

            return response()->json([
                'message' => 'Produto alterado com sucesso!',
                'data' => $product
            ], 200);
        } else {
            return response()->json([
                'message' => 'Não foi possível alterar o produto',
                'data' => ''
            ], 404);
        }
    }
}

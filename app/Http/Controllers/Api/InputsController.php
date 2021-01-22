<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Input;
use App\Models\Product;

class InputsController extends Controller
{
    public function getAll()
    {
        return Input::with('product')->get()->toArray();
    }

    public function post(Request $request)
    {
        $input = new Input();
        $input->product_id = $request->product;
        $input->amount = $request->amount;
        $input->date = $request->date;
        $input->unitary_value = $request->unitary_value;
        $input->total_value = $request->unitary_value * $request->amount;

        $product = Product::find($request->product);
        $input->after_amount = $product->current_amount + $request->amount;
        $input->before_amount = $product->current_amount;
        $product->current_amount = $input->after_amount;

        $input->save();
        $product->save();

        return response()->json([
            'message' => 'input criado com sucesso!',
            'data' => $input
        ], 200);
    }

    public function delete($id)
    {
        $input = Input::find($id);

        if (is_object($input)) {
            $product = Product::find($input->product_id);
            $product->current_amount = $input->before_amount;
            $product->save();
            $input->delete();

            return response()->json([
                'message' => 'Entrada deletada com sucesso!',
                'data' => $input
            ], 200);
        } else {
            return response()->json([
                'message' => 'Não foi possível deletar a entrada!',
                'data' => ''
            ], 404);
        }
    }

    public function put($id, Request $request)
    {
        $input = Input::find($id);

        if (is_object($input)) {
            if ($request->product != $input->product_id) {
                $product = Product::find($input->product_id);
                $product->current_amount = $input->before_amount;
                $input->product_id = $request->product;
            } else {
                $product = Product::find($request->product);
                $input->after_amount = $product->current_amount + $request->amount;
                $input->before_amount = $product->current_amount;
                $product->current_amount = $input->after_amount;
            }

            $input->amount = $request->amount;
            $input->date = $request->date;
            $input->unitary_value = $request->unitary_value;
            $input->total_value = $request->unitary_value * $request->amount;

            $input->save();

            return response()->json([
                'message' => 'Entrada alterada com sucesso!',
                'data' => $input
            ], 200);
        } else {
            return response()->json([
                'message' => 'Não foi possível alterar a entrada',
                'data' => ''
            ], 404);
        }
    }
}

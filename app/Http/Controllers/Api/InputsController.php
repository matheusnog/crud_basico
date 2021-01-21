<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Input;
use App\Models\Product;

class InputsController extends Controller
{
    public function getAll(){
        return Input::all();
    }

    public function post(Request $request){
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
            'message'=>'input criado com sucesso!',
            'data'=>$input],200);
    }
}

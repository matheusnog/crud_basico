<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleProduct;

class SalesController extends Controller
{
    public function post(Request $request)
    {
        $sale = new Sale();
        $sale->date = $request->date;
        $sale->user_id = 1;
        $sale->total_value = 2;
        $sale->save();

        $valor = 0;
        $contador = 0;

        foreach ($request->products as $product) {
            $saleProduct = new SaleProduct();
            $saleProduct->sale_id = $sale->id;
            $saleProduct->product_id = $product;
            $saleProduct->amount =  $request->amount[$contador];
            $saleProduct->unitary_value =  $request->unitary_value[$contador];

            $prod = Product::find($product);

            if ($prod->current_amount < $saleProduct->amount) {
                $sale->delete();
                return response()->json([
                    'message' => 'Não foi possível realizar a venda, a quantidade comprada é maior do que o estoque!',
                    'data' => $sale
                ], 400);
            }

            $saleProduct->before_amount =  $prod->current_amount;
            $saleProduct->after_amount =  $prod->current_amount - $request->amount[$contador];
            $prod->current_amount = $saleProduct->after_amount;
            $saleProduct->total_value =  $saleProduct->amount * $saleProduct->unitary_value;
            $valor += $saleProduct->total_value;

            $saleProduct->save();
            $prod->save();
            $contador++;
        }

        $sale->total_value = $valor;
        $sale->save();

        return response()->json([
            'message' => 'Venda realizada com sucesso!',
            'data' => $sale
        ], 200);
    }

    public function getAll(){        
        return Sale::with('user')->get()->toArray();
    }
}

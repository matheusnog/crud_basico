<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Input;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SaleProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function getAll(Request $request)
    {
        if ($request->pesquisa != '') {
            $prod = Product::with('inputs.product', 'saleProducts.sale', 'saleProducts.product');

            $inp = Input::with('product');
            $salProd = SaleProduct::with('product');

            if ($request->final && $request->inicial) {

                // pegando diretamente o input, sem acessar pelo produto
                $inp = $inp->where('date', '<=', $request->final)
                    ->where('date', '>=', $request->inicial)
                    ->whereHas('product', function (Builder $query) use ($request) {
                        $query->where('name', 'LIKE', $request->pesquisa . '%');
                    })->with([
                        'product' => function ($query) use ($request) {
                            $query->where('name', 'LIKE', $request->pesquisa . '%');
                        }
                    ]);

                $salProd = $salProd->whereHas('sale', function ($query) use ($request) {
                    $query->where('date', '<=', $request->final);
                    $query->where('date', '>=', $request->inicial);
                })->with([
                    'sale' => function ($query) use ($request) {
                        $query->where('date', '<=', $request->final);
                        $query->where('date', '>=', $request->inicial);
                    }
                ])
                    ->whereHas('product', function ($query) use ($request) {
                        $query->where('name', 'LIKE', $request->pesquisa . '%');
                    })->with([
                        'product' => function ($query) use ($request) {
                            $query->where('name', 'LIKE', $request->pesquisa . '%');
                        }
                    ]);

                // exit($saleProducts->toSql());
                //fazer dois arrays, um para inputs e um para saleProducts depois concatenar os dois num terceiro array, ordenar e retornar

                // funcionando parcialmente:
                // $prod = $prod->whereHas('inputs', function (Builder $query) use ($request) {
                //     $query->where('date', '<=', $request->final);
                //     $query->where('date', '>=', $request->inicial);
                // })->with([
                //     'inputs' => function ($query) use ($request) {
                //         $query->where('date', '<=', $request->final);
                //         $query->where('date', '>=', $request->inicial);
                //     }
                // ]);

                // $prod = $prod->whereHas('saleProducts', function (Builder $query) use ($request) {
                //     $query->whereHas('sale', function (Builder $query) use ($request) {
                //         $query->where('date', '>=', $request->inicial);
                //         $query->where('date', '<=', $request->final);
                //     });
                // })->with([
                //     'saleProducts' => function ($query) use ($request) {
                //         $query->whereHas('sale', function (Builder $query) use ($request) {
                //             $query->where('date', '>=', $request->inicial);
                //             $query->where('date', '<=', $request->final);
                //         });
                //     }
                // ]);
            }

            // if ($request->pesquisa)
            //     $prod = $prod->where('name', 'LIKE', $request->pesquisa . '%');

            // exit($prod->toSql());
            // ctrl + k + u ==> descomentar

            // $prod = $prod->get()->toArray();

            $inp = $inp->get()->toArray();
            $salProd = $salProd->get()->toArray();
            $entradaSaida = array_merge($inp, $salProd);

            usort(
                $entradaSaida,
                function ($a, $b) {
                    if ($a['created_at'] == $b['created_at']) return 0;
                    return (($a['created_at'] < $b['created_at']) ? -1 : 1);
                }
            );

            return $entradaSaida;
        } else {
            return Product::with('inputs.product', 'saleProducts.sale', 'saleProducts.product')->get()->toArray();
        }
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

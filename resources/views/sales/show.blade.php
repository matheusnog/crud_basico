@extends('layouts.main')

@section('title', 'Lista de vendas')

@section('content')
<div class="col-md-12">
    <h1 class="text-center">Produtos da venda</h1>
    <div class="text-center m-3">
        <a class="btn btn-primary" href="/sales/list">Voltar</a>
    </div>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th scope="col">Produto</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Quantidade antes</th>
                <th scope="col">Quantidade depois</th>
                <th scope="col">Valor unitário</th>
                <th scope="col">Valor total</th>
            </tr>
        </thead>
        <tbody id="tabela-corpo">
            @foreach($sale->saleProducts as $saleProduct)
            <tr>
                <td>{{ $saleProduct->product->name }}</td>
                <td>{{ $saleProduct->amount }}</td>
                <td>{{ $saleProduct->before_amount }}</td>
                <td>{{ $saleProduct->after_amount }}</td>
                <td>{{ $saleProduct->unitary_value }}</td>
                <td>{{ $saleProduct->total_value }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
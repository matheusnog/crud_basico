@extends('layouts.main')

@section('title', 'Welcome')

@section('content')
<div class="col-md-6 offset-md-3">
    <h1 class="text-center">Nova venda</h1>
    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label for="preco">Data</label>
            <input type="date" class="form-control" id="date" placeholder="Data">
        </div>
        <input type="button" class="btn btn-outline-primary" onclick="adicionarProduto()" value="Adicionar produto">
        <input type="button" class="btn btn-outline-danger" onclick="removerProduto()" value="Remover produto">
        <div id="produto-lista">
            <hr>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="name">Produto</label>
                    <select name="products" class="form-control product" id="products">
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="preco">Quantidade</label>
                    <input type="number" class="form-control amount" id="amount" placeholder="Quantidade">
                </div>
                <div class="form-group col-md-4">
                    <label for="preco">Valor unitário</label>
                    <input type="text" class="form-control unitary-value" id="unitary-value" placeholder="Valor unitário">
                </div>
            </div>

        </div>

        <input type="button" class="btn btn-primary" onclick="cadastraVenda()" value="Cadastrar" />
        <a href="/inputs/list" class="btn btn-outline-primary">Voltar</a>
    </form>
</div>

<script>
    var quantidade = 0;
    carregarProdutos();

    function cadastraVenda() {
        var date = $("#date").val()

        var produtos = []
        var quantidade = []
        var valorUnitario = []

        $(".product").each(function() {
            produtos.push($(this).val())
        })

        $(".amount").each(function() {
            quantidade.push($(this).val())
        })

        $(".unitary-value").each(function() {
            valorUnitario.push($(this).maskMoney('unmasked')[0])
        })

        console.log('produto: ' + produtos)
        console.log('qtd: ' + quantidade)
        console.log('valor unitario: ' + valorUnitario)

        $.ajax({
            type: "POST",
            url: 'http://127.0.0.1:8000/api/sales',
            dataType: 'json',
            data: {
                'products': produtos,
                'amount': quantidade,
                'unitary_value': valorUnitario,
                'date': date,
            },
            success: function(data) {
                console.log(data)
                alert("Product successfully registered")
            },
            error: function() {
                alert("Erro ao realizar a requisicao")
            }
        });
    }

    $(document).ready(function() {
        $(".unitary-value").maskMoney({
            prefix: "R$ ",
            decimal: ",",
            thousands: "."
        });
    });

    function adicionarProduto() {
        $("#produto-lista").append('<div class="form-row item-product-' + quantidade++ + '"><hr><div class="form-group col-md-4">' +
            '<label for="name">Produto</label>' +
            // '<select name="products" id="prod_1" class="form-control product" id="items-' + (quantidade - 1) + '">' +
            '<select name="products" class="form-control product" id="items-' + (quantidade - 1) + '">' +
            '</select>' +
            '</div>' +
            '<div class="form-group col-md-4">' +
            '<label for="preco">Quantidade</label>' +
            '<input type="number" class="form-control amount" id="amount" placeholder="Quantidade">' +
            '</div>' +
            '<div class="form-group col-md-4">' +
            '<label for="preco">Valor unitário</label>' +
            '<input type="text" class="form-control unitary-value" id="unitary-value" placeholder="Valor unitário">' +
            '</div></div>');
        carregarProdutos2();
        $(".unitary-value").maskMoney({
            prefix: "R$ ",
            decimal: ",",
            thousands: "."
        });
    }

    function removerProduto() {
        $("#produto-lista .item-product-" + --quantidade).remove()
    }

    function carregarProdutos() {
        $.ajax({
            type: "GET",
            url: 'http://127.0.0.1:8000/api/products',
            dataType: 'json',
            success: function(data) {
                data.map(u => {
                    var table = "<option value='" + u.id + "'>" + u.name + "</option>"

                    $('#products').append(table);
                })
            },
            error: function() {
                alert("Erro ao realizar a requisicao")
            }
        });
    }

    function carregarProdutos2() {
        $.ajax({
            type: "GET",
            url: 'http://127.0.0.1:8000/api/products',
            dataType: 'json',
            success: function(data) {
                data.map(u => {
                    console.log("u --> ", u.name)
                    var table = "<option value='" + u.id + "'>" + u.name + "</option>"
                    console.log(quantidade - 1)
                    $('#items-' + (quantidade - 1)).append(table);
                })
            },
            error: function() {
                alert("Erro ao realizar a requisicao")
            }
        });
    }
</script>

@endsection
@extends('layouts.main')

@section('title', 'Nova venda')

@section('content')
<div class="col-md-6 offset-md-3">
    <h1 class="text-center">Nova venda</h1>
    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label for="preco">Data</label>
            <input type="date" class="form-control" id="date" placeholder="Data" value="<?php echo date('Y-m-d'); ?>">
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
                    <input type="number" class="form-control amount" id="amount" onkeyup="campoAlterado()" placeholder="Quantidade">
                </div>
                <div class="form-group col-md-4">
                    <label for="preco">Valor unitário</label>
                    <input type="text" class="form-control unitary-value" id="unitary-value" placeholder="Valor unitário">
                </div>
            </div>

        </div>
        <!-- <input type="text" id="teste"> -->
        <input type="button" class="btn btn-primary button" onclick="cadastraVenda()" value="Cadastrar" />
        <a href="/sales/list" class="btn btn-outline-primary">Voltar</a>
    </form>
</div>

<script>
    // ok - ao selecionar um produto, trazer o valor médio de entrada, mais 20% 
    // criar uma tela de relatorio com base nas entradas e saidas do produto
    // ok - desabilitar botao quando o campo estiver sem dado
    // ok - dar aviso quando o valor informado for maior do que o estoque

    const formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2
    })

    var quantidade = 0;
    carregarProdutos();

    $("#products").change(function() {
        carregaValor();
    });

    function campoAlterado() {
        // verifica se o valor do campo é maior do que o estoque
        var valorCampo = ($("#amount").val())
        $.ajax({
            type: "GET",
            url: 'http://127.0.0.1:8000/api/products/' + $("#products").val(),
            dataType: 'json',
            success: function(data) {
                console.log(data)
                data.map(u => {
                    if (u.current_amount < valorCampo) {
                        $('.button').prop('disabled', true);
                        alert("Valor informado é maior do que o estoque")
                    } else {
                        $('.button').prop('disabled', false);
                    }
                })
            },
            error: function() {
                alert("Erro ao realizar a requisicao")
            }
        });
    }

    function carregaValor() {
        // carrega o valor médio do produto + 20% 
        $.ajax({
            type: "GET",
            url: 'http://127.0.0.1:8000/api/products/' + $("#products").val(),
            dataType: 'json',
            success: function(data) {
                console.log(data)
                var total = 0;
                var cont = 0;
                data.map(u => {
                    u.inputs.map(inp => {
                        total += inp.unitary_value;
                        cont++;
                    })
                })
                var valor = total / cont;
                $('#unitary-value').val(formatter.format(valor + (valor * 0.20)))
            },
            error: function() {
                alert("Erro ao realizar a requisicao")
            }
        });
    }

    function carregaValor2() {
        $.ajax({
            type: "GET",
            url: 'http://127.0.0.1:8000/api/products/' + $('#items-' + (quantidade - 1)).val(),

            dataType: 'json',
            success: function(data) {
                console.log(data)
                var total = 0;
                var cont = 0;
                data.map(u => {
                    u.inputs.map(inp => {
                        total += inp.unitary_value;
                        cont++;
                    })
                })
                var valor = total / cont;
                $('#unitary-value-' + (quantidade - 1)).val(formatter.format(valor + (valor * 0.20)))
            },
            error: function() {
                alert("Erro ao realizar a requisicao")
            }
        });
    }

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
                alert("Venda realizada com sucesso")
            },
            error: function(xhr, status, error) {
                var err = JSON.parse(xhr.responseText);
                alert(err.message);
            }
        });
    }

    // maskmoney
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
            '<input type="text" class="form-control unitary-value" id="unitary-value-' + (quantidade - 1) + '" placeholder="Valor unitário">' +
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
            url: 'http://127.0.0.1:8000/api/products/teste',
            dataType: 'json',
            success: function(data) {
                data.map(u => {
                    var table = "<option value='" + u.id + "'>" + u.name + "</option>"
                    $('#products').append(table);
                })
                // $("#teste").val($("#products").val());
                carregaValor();
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
                carregaValor2();
                console.log('#items-' + (quantidade - 1))
            },
            error: function() {
                alert("Erro ao realizar a requisicao")
            }
        });
    }
</script>

@endsection
@extends('layouts.main')

@section('title', 'Entradas e saídas')

@section('content')

<div class="col-md-10 offset-md-1">
    <h1 class="text-center">Entradas e saídas</h1>
    <div class="text-center m-3">
        <a class="btn btn-primary" href="/products/list">Produtos</a>
        <a class="btn btn-outline-primary" href="/inputs/list">Entradas</a>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="">Buscar: </label>
            <input type="text" class="form-control" id="search">
        </div>
        <div class="form-group col-md-4">
            <label for="preco">Data inicial: </label>
            <input type="date" class="form-control" id="data-inicial">
        </div>
        <div class="form-group col-md-4">
            <label for="preco">Data final: </label>
            <input type="date" class="form-control" id="data-final">
        </div>
    </div>

    <table class="table table-bordered text-center" id="tabela">
        <thead>
            <tr>
                <th scope="col" class="table-active">Tipo</th>
                <th scope="col">Data</th>
                <th scope="col">Produto</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Quantidade antes</th>
                <th scope="col">Quantidade depois</th>
                <th scope="col">Valor unitário</th>
                <th scope="col">Valor total</th>
            </tr>
        </thead>
        <tbody id="tabela-corpo">
        </tbody>
    </table>
</div>

<script>
    carregarTabela();

    $(document).ready(function() {
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tabela tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('#data-final').change(function() {
            console.log($('#data-inicial').val())
            console.log($('#data-final').val())
            $("#tabela tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf($('#data-final').val()) > -1)
            });

            // $('.data').each(function(index, value) {
            //     console.log(index + ':' + $(value).text());
            //     console.log($(value).text() >= $('#data-final').val())                
            // });
        });
    });

    const formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2
    })

    function carregarTabela() {
        var id = $("#id-hidden").val()
        var entrada = [];
        var saida = [];
        $.ajax({
            type: "GET",
            url: 'http://127.0.0.1:8000/api/products',
            dataType: 'json',
            success: function(data) {
                data.map(u => {
                    u.inputs.map(inp => {
                        entrada.push(inp);
                    })

                    u.sale_products.map(inp => {
                        saida.push(inp);
                    })
                })

                var entradaSaida = entrada.concat(saida);
                // console.log(entradaSaida)

                // compara as datas para realizar o sort
                function compare(a, b) {
                    return a.created_at < b.created_at ? -1 : a.created_at > b.created_at ? 1 : 0;
                }

                entradaSaida.sort(compare);

                entradaSaida.map(inp => {
                    // console.log(inp)
                    $table = "<tr>";
                    $table += "<td " + (inp.date != null ? "class='bg-success'>Entrada" : "class='bg-danger'>Saída") + "</td>";
                    $table += "<td class='data'>" + (inp.date != null ? inp.date : inp.sale.date) + "</td>";
                    $table += "<td>" + inp.product.name + "</td>";
                    $table += "<td>" + inp.amount + "</td>";
                    $table += "<td>" + inp.before_amount + "</td>";
                    $table += "<td>" + inp.after_amount + "</td>";
                    $table += "<td>" + formatter.format(inp.unitary_value) + "</td>";
                    $table += "<td>" + formatter.format(inp.total_value) + "</td></tr>";
                    $('#tabela-corpo').append($table);
                })
            },
            error: function() {
                alert("Erro ao realizar a requisicao")
            }
        });
    }
</script>
@endsection
@extends('layouts.main')

@section('title', 'Lista de vendas')

@section('content')
<div class="col-md-12">
    <h1 class="text-center">Vendas</h1>
    <div class="text-center m-3">
        <a class="btn btn-primary" href="/sales/new">Nova venda</a>
    </div>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th scope="col">Usuário</th>
                <th scope="col">Data</th>
                <th scope="col">Valor total</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody id="tabela-corpo">
        </tbody>
    </table>
</div>
<input type="hidden" id="id-hidden">
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Excluir produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja excluir esse produto?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-primary" onclick="excluirEntrada()">Sim</button>
            </div>
        </div>
    </div>
</div>

<script>
    carregarTabela();

    const formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2
    })

    function carregarTabela() {
        $.ajax({
            type: "GET",
            url: 'http://127.0.0.1:8000/api/sales',
            dataType: 'json',
            success: function(data) {
                var tamanho = data.length;
                var contador = 0;
                var ver = "";
                data.map(u => {
                    $table = "<tr>";
                    $table += "<td>" + u.user.name + "</td>";
                    $table += "<td>" + u.date + "</td>";
                    $table += "<td>" + formatter.format(u.total_value) + "</td>";
                    $table += "<td><a class='btn btn-primary' href='/sales/show/" + u.id + "'>Produtos da venda</a></td>";
                    $table += "</tr>";

                    $('#tabela-corpo').append($table);
                })
            },
            error: function() {
                alert("Erro ao realizar a requisicao")
            }
        });
    }

    function carregarHidden(id) {
        $('#id-hidden').val(id);
        console.log($('#id-hidden').val());
    }

    function excluirEntrada() {
        var id = $("#id-hidden").val()
        $.ajax({
            type: "delete",
            url: 'http://127.0.0.1:8000/api/inputs/' + id,
            dataType: 'json',
            success: function(data) {
                console.log(data)
                carregarTabela();
                $("#tabela-corpo").empty();
                $('#exampleModal').modal('hide');
            },
            error: function() {
                alert("Erro ao realizar  requisicao")
            }
        });
    }
</script>

@endsection
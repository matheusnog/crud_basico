@extends('layouts.main')

@section('title', 'Lista de produtos')

@section('content')
<div class="col-md-10 offset-md-1">
    <h1 class="text-center">Produtos</h1>
    <div class="text-center m-3">
        <a class="btn btn-primary" href="/products/new">Novo produto</a>
        <a class="btn btn-outline-primary" href="/inputs/list">Entradas</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Código</th>
                <th scope="col">Quantidade atual</th>
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
                <button type="button" class="btn btn-primary" onclick="excluirProduto()">Sim</button>
            </div>
        </div>
    </div>
</div>

<script>
    carregarTabela();

    function carregarTabela() {
        $.ajax({
            type: "GET",
            url: 'http://127.0.0.1:8000/api/products',
            dataType: 'json',
            success: function(data) {
                data.map(u => {
                    console.log("u --> ", u)

                    $table = "<tr>";
                    $table += "<td>" + u.id + "</td>";
                    $table += "<td>" + u.name + "</td>";
                    $table += "<td>" + u.code + "</td>";
                    $table += "<td>" + u.current_amount + "</td>";
                    $table += "<td><a class='btn btn-primary' href='/products/edit/" + u.id + "'>Editar</a> ";
                    $table += "<button type='button'  class='btn btn-danger' data-toggle='modal' data-target='#exampleModal' onclick='carregarHidden(" + u.id + ")'>Excluir</button> ";
                    $table += "<a class='btn btn-success' href='/products/show/" + u.id + "'>Ver entradas</a>";
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

    function excluirProduto() {
        var id = $("#id-hidden").val()
        $.ajax({
            type: "delete",
            url: 'http://127.0.0.1:8000/api/products/' + id,
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
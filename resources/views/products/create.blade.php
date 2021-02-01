@extends('layouts.main')

@section('title', 'Criar produto')

@section('content')
<div class="col-md-6 offset-md-3">
    <h1 class="text-center">Novo produto</h1>
    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Nome">
        </div>
        <div class="form-group">
            <label for="preco">Código</label>
            <input type="number" class="form-control" id="code" placeholder="Código">
        </div>
        <!-- <div class="form-group">
                <label for="codigo">Current amount</label>
                <input type="text" class="form-control" name="current_amount" id="current_amount" placeholder="Current amount">
            </div> -->
        <input type="button" class="btn btn-primary" onclick="cadastraProduto()" value="Cadastrar" />
        <a href="/products/list" class="btn btn-outline-primary">Voltar</a>
    </form>
</div>

<script>
    function cadastraProduto() {
        var name = $("#name").val()
        var code = $("#code").val()
        // var current_amount = $("#current_amount").val()

        $.ajax({
            type: "POST",
            url: 'http://127.0.0.1:8000/api/products/',
            dataType: 'json',
            data: {
                'name': name,
                'code': code,
                // 'current_amount': current_amount
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
</script>

@endsection
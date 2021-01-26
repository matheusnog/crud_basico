@extends('layouts.main')

@section('title', 'Lista de produtos')

@section('content')
<div class="col-md-6 offset-md-3">
    <h1 class="text-center">Editar produto</h1>
    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="preco">Code</label>
            <input type="text" class="form-control" name="code" id="code" value="{{ $product->code }}" placeholder="Code">
        </div>
        <!-- <div class="form-group">
                <label for="codigo">Current amount</label>
                <input type="text" class="form-control" name="current_amount" id="current_amount" value="{{ $product->current_amount }}" placeholder="Código">
            </div> -->
        <input type="button" class="btn btn-primary" onclick="editProduct()" value="Editar" />
        <a href="/products/list" class="btn btn-outline-primary">Voltar</a>
    </form>
</div>
<input type="hidden" id="id-hidden" value="{{ $product->id }}">

<script>
    function editProduct() {
        var id = $("#id-hidden").val()
        var name = $("#name").val()
        var code = $("#code").val()
        var current_amount = $("#current_amount").val()
        $.ajax({
            type: "PUT",
            url: 'http://127.0.0.1:8000/api/products/' + id,
            dataType: 'json',
            data: {
                'name': name,
                'code': code,                
            },
            success: function(data) {
                console.log(data)
                alert("Produto editado com sucesso")
            },
            error: function() {
                alert("Erro ao realizar a requisicao")
            }
        });
    }
</script>

@endsection
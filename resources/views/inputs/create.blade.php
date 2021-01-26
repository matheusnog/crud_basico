@extends('layouts.main')

@section('title', 'Nova entrada')

@section('content')
    <div class="col-md-6 offset-md-3">
        <h1 class="text-center">Nova entrada</h1>
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Produto</label>
                <select name="products" class="form-control" id="products">
                </select>
            </div>
            <div class="form-group">
                <label for="preco">Quantidade</label>
                <input type="number" class="form-control" id="amount" placeholder="Quantidade">
            </div>
            <div class="form-group">
                <label for="preco">Data</label>
                <input type="date" class="form-control" id="date" placeholder="Data">
            </div>
            <div class="form-group">
                <label for="preco">Valor unitário</label>
                <input type="text" class="form-control" id="unitary-value" placeholder="Valor unitário">
            </div>
            <input type="button" class="btn btn-primary" onclick="cadastraEntrada()" value="Cadastrar" />
            <a href="/inputs/list" class="btn btn-outline-primary">Voltar</a>
        </form>
    </div>

<script>
    carregarProdutos();
    $(document).ready(function() {
        $("#unitary-value").maskMoney({
            prefix: "R$ ",
            decimal: ",",
            thousands: "."
        });
    });

    function carregarProdutos() {
        $.ajax({
            type: "GET",
            url: 'http://127.0.0.1:8000/api/products',
            dataType: 'json',
            success: function(data) {
                data.map(u => {
                    console.log("u --> ", u.name)
                    var table = "<option value='" + u.id + "'>" + u.name + "</option>"

                    $('#products').append(table);
                })
            },
            error: function() {
                alert("Erro ao realizar a requisicao")
            }
        });
    }

    function cadastraEntrada() {
        var product = $("#products option:selected").val()
        var amount = $("#amount").val()
        var date = $("#date").val()
        var unitary_value = $('#unitary-value').maskMoney('unmasked')[0];

        console.log(product)
        console.log(amount)
        console.log(date)
        console.log(unitary_value)

        $.ajax({
            type: "POST",
            url: 'http://127.0.0.1:8000/api/inputs',
            dataType: 'json',
            data: {
                'product': product,
                'amount': amount,
                'date': date,
                'unitary_value': unitary_value,
            },
            success: function(data) {
                console.log(data)
                alert("Product successfully registered")
            },
            error: function(data) {    
                console.log(data)          
                alert("Erro ao realizar a requisicao")
            }
        });
    }
</script>

@endsection
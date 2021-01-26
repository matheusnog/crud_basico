@extends('layouts.main')

@section('title', 'Editar entrada')

@section('content')
    <div class="col-md-6 offset-md-3">
        <h1 class="text-center">Nova entrada</h1>
        <form action="" method="POST">
            @csrf
            <div class="form-group option">
                <label for="name">Produto</label>
                <select name="products" class="form-control" id="products" disabled>
                </select>
            </div>
            <div class="form-group">
                <label for="preco">Quantidade</label>
                <input type="number" class="form-control" id="amount" placeholder="Quantidade" value="{{ $input->amount }}">
            </div>
            <div class="form-group">
                <label for="preco">Data</label>
                <input type="date" class="form-control" id="date" placeholder="Data" value="{{ $input->date }}">
            </div>
            <div class="form-group">
                <label for="preco">Valor unitário</label>
                <input type="text" class="form-control" id="unitary-value" placeholder="Valor unitário" value="{{ number_format($input->unitary_value, 2, '.', '') }}">
            </div>
            <input type="hidden" id="id-hidden" value="{{ $input->id }}">
            <input type="hidden" value="{{ $input->product_id }}" id="product-hidden">
            <input type="button" class="btn btn-primary" onclick="editarEntrada()" value="Salvar" />
            <a href="/inputs/list" class="btn btn-outline-primary">Voltar</a>
        </form>
    </div>

<script>
    carregarProdutos();
    formata(); 

    function formata() {
        $("#unitary-value").maskMoney({
            prefix: "R$ ",
            decimal: ",",
            thousands: "."
        }).trigger('mask.maskMoney');
    }

    function carregarProdutos() {
        product_hidden = $("#product-hidden").val(); 
        $.ajax({
            type: "GET",
            url: 'http://127.0.0.1:8000/api/products',
            dataType: 'json',
            success: function(data) {                
                data.map(u => {
                    console.log("u --> ", u.name)
                    var table = "<option value='" + u.id + "' "+ (u.id == product_hidden ? "selected" : "") +">" + u.name + "</option>"

                    $('#products').append(table);
                })
            },
            error: function() {
                alert("Erro ao realizar a requisicao")
            }
        });
    }    

    function editarEntrada() {
        var product = $("#products option:selected").val()
        var amount = $("#amount").val()
        var date = $("#date").val()
        var unitary_value = $('#unitary-value').maskMoney('unmasked')[0];
        var id = $("#id-hidden").val()

        console.log(product)
        console.log(amount)
        console.log(date)
        console.log(unitary_value)

        $.ajax({
            type: "PUT",
            url: 'http://127.0.0.1:8000/api/inputs/' + id,
            dataType: 'json',
            data: {
                'product': product,
                'amount': amount,
                'date': date,
                'unitary_value': unitary_value,
            },
            success: function(data) {
                console.log(data)
                alert("Entrada editada com sucesso")
            },
            error: function(data) {
                console.log(data)
                alert("Erro ao realizar a requisicao")
            }
        });
    }
</script>

@endsection
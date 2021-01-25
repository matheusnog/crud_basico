<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Ver produto</title>
</head>

<body>
    <!-- {{$product->inputs->where('product_id', '1')->last()}} -->

    <div class="col-md-10 offset-md-1">
        <h1 class="text-center">Entradas do produto: {{ $product->name }}</h1>
        <div class="text-center m-3">
            <a class="btn btn-primary" href="/products/list">Produtos</a>
            <a class="btn btn-outline-primary" href="/inputs/list">Entradas</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Data</th>
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
    <input type="hidden" id="id-hidden" value="{{ $product->id }}">
</body>
<script>
    carregarTabela();

    const formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2
    })

    function carregarTabela() {
        var id = $("#id-hidden").val()
        $.ajax({
            type: "GET",
            url: 'http://127.0.0.1:8000/api/products/' + id,
            dataType: 'json',
            success: function(data) {
                console.log(data)
                var ver = "";
                data.map(u => {
                    u.inputs.map(inp => {
                        $table = "<tr>";
                        $table += "<td>" + inp.date + "</td>";
                        $table += "<td>" + inp.amount + "</td>";
                        $table += "<td>" + inp.before_amount + "</td>";
                        $table += "<td>" + inp.after_amount + "</td>";
                        $table += "<td>" + formatter.format(inp.unitary_value) + "</td>";
                        $table += "<td>" + formatter.format(inp.total_value) + "</td></tr>";
                        $('#tabela-corpo').append($table);
                    })
                })
            },
            error: function() {
                alert("Erro ao realizar a requisicao")
            }
        });
    }
</script>

</html>
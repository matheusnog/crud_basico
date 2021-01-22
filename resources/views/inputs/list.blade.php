<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Ver Produtos</title>
</head>

<body>
    <div class="col-md-12">
        <h1 class="text-center">Entradas</h1>
        <div class="text-center m-3">
            <a class="btn btn-primary" href="/inputs/new">Nova entrada</a>
            <a class="btn btn-outline-primary" href="/products/list">Produtos</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Valor total</th>
                    <th scope="col">Valor unitário</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Quantidade antes</th>
                    <th scope="col">Quantidade depois</th>
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
</body>
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
            url: 'http://127.0.0.1:8000/api/inputs',
            dataType: 'json',
            success: function(data) {
                var tamanho = data.length;
                var contador = 0;
                var ver = "";
                data.map(u => {
                    console.log("u --> ", u)
                    contador++;

                    // os ultimos registros de cada produtos podem ser alterados

                    $table = "<tr>";
                    $table += "<td>" + u.date + "</td>";
                    $table += "<td>" + u.product.name + "</td>";
                    $table += "<td>" + formatter.format(u.total_value) + "</td>";
                    $table += "<td>" + formatter.format(u.unitary_value) + "</td>";
                    $table += "<td>" + u.amount + "</td>";
                    $table += "<td>" + u.before_amount + "</td>";
                    $table += "<td>" + u.after_amount + "</td>";
                    if (contador == tamanho) {
                        $table += "<td><a class='btn btn-primary' href='/inputs/edit/" + u.id + "'>Editar</a> ";
                        $table += "<button type='button'  class='btn btn-danger' data-toggle='modal' data-target='#exampleModal' onclick='carregarHidden(" + u.id + ")'>Excluir</button> ";
                        $table += "<a class='btn btn-success' href='/inputs/show/" + u.id + "'>Ver dados</a></td>";
                        $table += "</tr>";
                    } else {
                        $table += "<td></td>";
                        $table += "</tr>";
                    }
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

</html>
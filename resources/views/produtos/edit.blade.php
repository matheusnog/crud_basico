<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="col-md-6 offset-md-3">
        <h1 class="text-center">Editar produto</h1>
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="nome" value="{{ $produto->nome }}" placeholder="Nome">
            </div>
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="text" class="form-control" name="preco" value="{{ $produto->preco }}" placeholder="Preço">
            </div>
            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" class="form-control" name="codigo" value="{{ $produto->codigo }}" placeholder="Código">
            </div>
            <input type="button" class="btn btn-primary" onclick="editarProduto()" value="Editar" />
            <a href="/produtos/lista" class="btn btn-outline-primary">Voltar</a>

        </form>
    </div>
    
</body>

<script>
    function editarProduto() {
        var id = $("#id-hidden").val()
        var nome = $("#nome").val()
        var preco = $("#preco").val()
        var codigo = $("#codigo").val()
        $.ajax({
            type: "PUT",
            url: 'http://127.0.0.1:8000/api/users/'+ id,
            dataType: 'json',
            data: {
                'name': name,
                'email': email,
                'password': password,
            },
            //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(data) {
                console.log(data)
                alert("Usuário editado com sucesso")
            },
            error: function() {
                alert("Erro ao realizar  requisicao")
            }
        });
    }
</script>
</html>
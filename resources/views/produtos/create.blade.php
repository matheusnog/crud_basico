<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="col-md-6 offset-md-3">
        <h1 class="text-center">Cadastrar produto</h1>
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome" aria-describedby="emailHelp" placeholder="Nome">
            </div>
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="number" class="form-control" id="preco" placeholder="Preço">
            </div>
            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Código">
            </div>
            <input type="button" class="btn btn-primary" onclick="cadastraProduto()" value="Cadastrar" />
            <a href="/produtos/lista" class="btn btn-outline-primary">Voltar</a>
        </form>
    </div>
    
</body>
<script>
function cadastraProduto()
{
    var nome = $("#nome").val()
    var preco = $("#preco").val()
    var codigo = $("#codigo").val()

  $.ajax({
    type : "POST",
    url : 'http://127.0.0.1:8000/api/produtos',
    dataType: 'json',
    data : {'nome': nome, 'preco': preco, 'codigo': codigo},
    //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    success : function(data) {
      console.log(data)
      alert("Produto cadastrado com sucesso")
    },
    error: function(){
        alert("Erro ao realizar a requisicao")
    }
  });
}
</script>
</html>
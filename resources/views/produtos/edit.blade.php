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
        <form action="{{ route('editar_produto', ['id' => $produto->id]) }}" method="POST">
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
            <button type="submit" class="btn btn-primary">Editar</button>
            <a href="/produtos/lista" class="btn btn-outline-primary">Voltar</a>

        </form>
    </div>
    
</body>
</html>
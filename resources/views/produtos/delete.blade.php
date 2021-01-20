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
        <h1 class="text-center">Deletar produto</h1>
        <form action="{{ route('excluir_produto', ['id' => $produto->id]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tem certeza que deseja excluir esse usuário? </label>
                <input type="text" class="form-control" name="nome" value="{{ $produto->nome }}">
            </div>
            <button type="submit" class="btn btn-primary">Sim</button>
            <a href="/produtos/lista" class="btn btn-outline-primary">Voltar</a>
        </form>  
    </div>
    
</body>
</html>
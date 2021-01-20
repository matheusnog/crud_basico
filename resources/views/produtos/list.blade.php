<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Ver Usuários</title>
</head>
<body>
<h1 class="text-center">Produtos</h1>
<div class="text-center m-3">
    <a class="btn btn-primary" href="/produtos/novo">Cadastrar novo produto</a>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Preço</th>
      <th scope="col">Código</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($produtos as $produto)
        <tr>
        <th scope="row">{{ $produto->id }}</th>
        <td>{{ $produto->nome }}</td>
        <td>{{ $produto->preco }}</td>
        <td>{{ $produto->codigo }}</td>
        <td>
            <a class="btn btn-primary" href="/produtos/editar/{{$produto->id}}">Editar</a>
            <a class="btn btn-danger" href="/produtos/excluir/{{$produto->id}}">Excluir</a>
        </td>
        </tr>    
    @endforeach
  </tbody>
</table>
    
    
</body>
</html>
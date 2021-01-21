<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Editar usuário</title>
</head>

<body>
    <div class="col-md-6 offset-md-3">
        <h1 class="text-center">Editar usuário</h1>
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="nome" id="name" aria-describedby="emailHelp" placeholder="Nome" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <label for="preco">Email</label>
                <input type="text" class="form-control" id="email" placeholder="Email" value="{{ $user->email }}">
            </div>
            <div class="form-group">
                <label for="codigo">Senha</label>
                <input type="password" class="form-control" id="password" placeholder="Senha">
            </div>
            <input type="hidden" id="id-hidden" value="{{ $user->id }}">
            <input type="button" class="btn btn-primary" onclick="editarUsuario()" value="Editar" />
            <a href="/users/list" class="btn btn-outline-primary">Voltar</a>
        </form>
    </div>
</body>

<script>
    function editarUsuario() {
        var id = $("#id-hidden").val()
        var name = $("#name").val()
        var email = $("#email").val()
        var password = $("#password").val()
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver produto</title>
</head>
<body>
    <label for="">Nome: </label>
    <input type="text" name="name" value="{{ $user->name }}">
    <label for="">Email: </label>
    <input type="text" name="email" value="{{ $user->email }}">
    <label for="">Senha: </label>
    <input type="password" name="password">
    <button>Salvar</button>
</body>
</html>
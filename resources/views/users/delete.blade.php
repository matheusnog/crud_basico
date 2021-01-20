<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver produto</title>
</head>
<body>
    <form action="{{ route('excluir_usuario', ['id' => $user->id]) }}" method="POST">
        @csrf
        <label for="">Tem certeza que deseja excluir esse usuário? </label> <br>
        <input type="text" name="name" value="{{ $user->name }}">
        <button>Sim</button>
    </form>
    
</body>
</html>
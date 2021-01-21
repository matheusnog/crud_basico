<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <title>Ver Usuários</title>
</head>

<body>
  <h1 class="text-center">Usuários</h1>
  <div class="text-center">
    <a class="btn btn-primary m-3" href="/users/new">Cadastrar novo usuário</a>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody id="tabela-corpo">
    </tbody>
    <!-- <tbody>
    @foreach($users as $user)
        <tr>
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <a class="btn btn-primary" href="/users/editar/{{$user->id}}">Editar</a>
            <a class="btn btn-danger" href="/users/excluir/{{$user->id}}">Excluir</a>
        </td>
        </tr>    
    @endforeach
    </tbody> -->
  </table>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Excluir usuário</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Você tem certeza que deseja excluir esse usuário?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
          <button type="button" class="btn btn-primary" onclick="excluirUsuario()">Sim</button>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" id="id-hidden">
</body>

<script>
  carregarTabela();

  function carregarTabela() {
    $.ajax({
      type: "GET",
      url: 'http://127.0.0.1:8000/api/users',
      dataType: 'json',
      //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      success: function(data) {
        data.map(u => {
          console.log("u --> ", u.name)

          $table = "<tr>";
          $table += "<td>" + u.id + "</td>";
          $table += "<td>" + u.name + "</td>";
          $table += "<td>" + u.email + "</td>";
          $table += "<td><a class='btn btn-primary' href='/users/editar/" + u.id + "'>Editar</a> ";
          $table += "<button type='button'  class='btn btn-danger' data-toggle='modal' data-target='#exampleModal' onclick='carregarHidden(" + u.id + ")'>Excluir</button></td>";
          $table += "</tr>";

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

  function excluirUsuario() {
    var id = $("#id-hidden").val()
    $.ajax({
      type: "delete",
      url: 'http://127.0.0.1:8000/api/users/' + id,
      dataType: 'json',
      //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
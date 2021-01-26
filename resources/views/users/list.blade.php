@extends('layouts.main')

@section('title', 'Lista de usuários')

@section('content')
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

@endsection
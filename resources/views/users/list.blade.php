@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Legajo</th>
                        <th scope="col">Nombre y apellido</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rol</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->university_id}}</td>
                            <td>{{$user->getFullName()}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->getType()}}</td>
                            <td>
                                <a href="{{route('user.edit', $user->id)}}">Editar</a>
                                <a href="#" data-toggle="modal" data-target="#deleteModal" data-userid="{{$user->id}}">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                      <tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Eliminar usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="#">
              <input type="text" value="" id="userid">
              ¿Estás seguro de eliminar este usuario?

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Eliminar</button>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('js-script')
    <script>

      $('#deleteModal').on('show.bs.modal', function(event){
        alert('hola');
        var button = $(event.relatedTarget)

        var userid = button.data('userid')
        var modal = $(this)
        console.log('hola')
        console.log(userid)
        modal.find('.modal-body #userid').val(userid)
      });
    </script>
@endsection
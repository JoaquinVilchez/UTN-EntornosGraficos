@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
          @include('elements.messages')
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
        <form action="{{route('user.destroy')}}" method="POST">
          @csrf
            <div class="modal-body">
                <input type="hidden" value="" id="userid" name="userid">
                ¿Estás seguro de eliminar este usuario?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
        </form>
        </div>
      </div>
    </div>
@endsection

@section('js-script')
    <script>

      $('#deleteModal').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)

        var userid = button.data('userid')
        var modal = $(this)
        modal.find('.modal-body #userid').val(userid)
      });
    </script>
@endsection
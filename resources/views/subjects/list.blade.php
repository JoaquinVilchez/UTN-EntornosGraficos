@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
          @include('elements.messages')
            <div class="col-12">
                <div class="container">
                    <div class="row">
                        <div class="ml-auto"><a href="{{route('subject.create')}}" type="button" class="btn btn-primary">Nueva materia</a></div>
                    </div>
                </div>
                    <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Año de cursado</th>
                        <th scope="col">Carrera</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($subjects as $subject)
                        <tr>
                            <td>{{$subject->id}}</td>
                            <td>{{$subject->name}}</td>
                            <td>{{$subject->level}}</td>
                            <td>{{$subject->career}}</td>         
                            <td>

                             <a href="{{route('subject.edit', $subject->id)}}">Editar</a>
                                <a href="#" data-toggle="modal" data-target="#deleteModal" data-subjectid="{{$subject->id}}">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                      <tr>
                    </tbody>
                  </table>
                  {{ $subjects->links() }}
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
        <form action="{{route('subject.destroy')}}" method="POST">
          @csrf
            <div class="modal-body">
                <input type="hidden" value="" id="subjectid" name="subjectid">
                ¿Estás seguro de eliminar esta materia?
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

        var subjectid = button.data('subjectid')
        var modal = $(this)
        modal.find('.modal-body #subjectid').val(subjectid)
      });
    </script>
@endsection
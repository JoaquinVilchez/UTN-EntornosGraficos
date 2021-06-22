@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
          @include('elements.messages')
            <div class="col-12">
                <div class="container">
                    <div class="row">
                        <div class="ml-auto"><a href="#" type="button" class="btn btn-primary">Inscribirse a una nueva consulta</a></div>
                    </div>
                </div>
                    <h1>Inscripciones para el alumno {{$user->getFullName()}}</h1>
                    <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha y hora</th>
                        <th scope="col">Docente</th>
                        <th scope="col">Materia</th>
                        <th scope="col">Estado de la consulta</th>
                        <th scope="col">Estado de inscripción</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($inscriptions as $inscription)
                        
                          <tr>
                            <td>{{$inscription->id}}</td>
                            <td>{{$inscription->meeting->datetime}}</td>
                            <td>{{$inscription->meeting->teacher->getFullName()}}</td>
                            <td>{{$inscription->meeting->subject->name}}</td>
                            <td>{{$inscription->meeting->getState()}}</td>
                            <td>{{$inscription->getState()}}</td>
                            <td>
                              @if($inscription->meeting->state == 'pending' && $inscription->state == 'enrolled')
                                <a href="#" data-toggle="modal" data-target="#deleteModal" data-inscriptionid="{{$inscription->id}}" type="button" class="btn btn-danger">Cancelar</a>
                              @endif
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
            <h5 class="modal-title" id="deleteModalLabel">Cancelar inscripción</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <form action="{{route('inscription.cancel')}}" method="POST">
          @csrf
            <div class="modal-body">
                <input type="hidden" value="" id="inscriptionid" name="inscriptionid">
                ¿Estás seguro de cancelar la inscripción a esta consulta?
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

    var inscriptionid = button.data('inscriptionid')
    var modal = $(this)
    modal.find('.modal-body #inscriptionid').val(inscriptionid)
  });
</script>

@endsection
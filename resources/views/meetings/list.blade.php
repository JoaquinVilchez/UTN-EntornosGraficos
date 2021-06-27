@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="container d-flex justify-content-center">
            <div class="col-12">
                @include('elements.messages')
                <div class="d-flex justify-content-between align-items-center my-2">
                    <h2>Consultas</h2>
                    <div>
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#importExcelModal">Importar con excel</a>
                        <a href="{{route('meetings.create')}}" class="btn btn-primary">Nueva consulta</a>
                    </div>
                </div>
                @if($meetings->count() > 0)
                    <table class="table table-sm table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Materia</th>
                            <th scope="col">Profesor</th>
                            <th scope="col">Dia y hora</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Aula</th>
                            <th scope="col">Link</th>
                            <th scope="col">Estado</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($meetings as $meeting)
                                <tr>
                                <td>{{$meeting->subject->name}}</td>
                                <td>{{$meeting->teacher->getFullName()}}</td>
                                <td>{{$meeting->getDayAndHour()}}</td>
                                <td>{{$meeting->getType()}}</td>
                                <td>
                                    @if($meeting->type == 'face-to-face')
                                        {{$meeting->classroom}}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($meeting->type == 'virtual')
                                    <a target="_blank" href="{{$meeting->meeting_url}}">{{$meeting->meeting_url}}</a> 
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{!!$meeting->getState()!!}</td>
                                <td>
                                    <a href="{{route('meetings.edit', $meeting->id)}}"><i class="fas fa-edit"></i></a>
                                    <a href="#" data-toggle="modal" data-toggle="modal" data-target="#deleteMeetingModal" data-meetingid="{{$meeting->id}}"><i class="fas fa-trash"></i></a>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center">
                        {{$meetings->links()}}
                        <a href="{{route('meetings.export')}}" class="btn btn-success">Exportar a Excel</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="importExcelModal" tabindex="-1" aria-labelledby="importExcelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('meetings.import')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importExcelModalLabel">Importar desde Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="text-center"><i class="far fa-file-excel"></i></h1>
                        <div class="form-group">
                            <label for="inputFileExcel">Cargar archivo Excel</label>
                            <input type="file" name="file" class="form-control-file" id="inputFileExcel">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Importar</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteMeetingModal" tabindex="-1" aria-labelledby="deleteMeetingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteMeetingModalLabel">Eliminar consulta</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form action="{{route('meetings.destroy')}}" method="POST">
            @csrf
              <div class="modal-body">
                  <input type="hidden" value="" id="meetingid" name="meetingid">
                  ¿Estás seguro de eliminar esta consulta?
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

        $('#deleteMeetingModal').on('show.bs.modal', function(event){
          var button = $(event.relatedTarget)

          var meetingid = button.data('meetingid')
          var modal = $(this)
          modal.find('.modal-body #meetingid').val(meetingid)
        });
      </script>
  @endsection
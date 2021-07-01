@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="container d-flex justify-content-center">
                <div class="col-12">
                    @include('elements.messages')
                    <div class="d-flex justify-content-between align-items-center my-2">
                        <h2>Mis próximas consultas</h2>
                        <div>
                            <a href="{{redirect()->back()}}" class="btn btn-dark">Volver</a>
                            <a href="#" class="btn btn-primary">Ver historial</a>
                        </div>
                    </div>
                    @if($next_meetings->count() > 0)

                        @php $i=0; @endphp

                        @foreach ($next_meetings as $meeting)

                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                                            Consultas del {{$meeting->getDayAndHour()}} - {{$meeting->subject->name}}
                                        </button>
                                        </h5>
                                    </div>

                                    <div id="collapse{{$i}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <table class="table table-sm table-hover">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Fecha y hora</th>
                                                    <th scope="col">Tipo</th>
                                                    <th scope="col">Aula</th>
                                                    <th scope="col">Link</th>
                                                    <th scope="col">Estado</th>
                                                    <th scope="col"></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @php $dates = $meeting->next_meetings(5) @endphp

                                                @foreach ($dates as $date)
                                                <tr>
                                                    <td>{{$date->format('d-m-Y h:i')}}</td>
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
                                                    <td>
                                                        @if ($meeting->isActiveForDate($date))
                                                            <span class="badge badge-success">Activo</span>
                                                        @else
                                                            <span class="badge badge-danger">Cancelado</span>
                                                        @endif
                                                    </td>
                                                    <td>

                                                        <a class="" href="{{route('meetings.meeting_details', [$meeting->id, $date->format('Y-m-d h:i')])}}"> Ver detalles</a>

                                                        @if ($meeting->isActiveForDate($date))
                                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancelModal" data-meetingid="{{$meeting->id}}">Cancelar</a>
                                                        @endif
                                                    </td>
                                                    </tr>

                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @php $i++; @endphp

                        @endforeach

                    @endif

                </div>
            </div>
        </div>
    </div>


  <!-- Modal -->
  <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cancelModalLabel">Cancelar Consulta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <form action="{{route('meetings.cancel')}}" method="POST">
        @csrf
          <div class="modal-body">
              <input type="hidden" value="" id="meetingid" name="meetingid">
              ¿Estás seguro de que desea cancelar esta consulta?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger">Aceptar</button>
          </div>
      </form>
      </div>
    </div>
  </div>
@endsection

@section('js-script')
    <script>
        $('#cancelModal').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)

        var meetingid = button.data('meetingid')
        var modal = $(this)
        modal.find('.modal-body #meetingid').val(meetingid)
        });
    </script>
@endsection
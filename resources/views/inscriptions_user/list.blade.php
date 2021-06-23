@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
          @include('elements.messages')
            <div class="col-12">
                    <div class="row d-flex align-items-center justify-content-between border-bottom pb-2">
                        <h1>Mis consultas</h1>
                        <div>
                            <a href="#" class="btn btn-primary">Volver</a>
                            <a href="#" class="btn btn-primary">Nueva Consulta</a>
                        </div>
                    </div>
                    <div class="row w-100 mb-3">
                        <div class="d-flex mt-3">
                            <div class="mr-2">
                                <input class="form-control" style="width: 15.5rem;" placeholder="Buscar por materia o profesor">
                            </div>
                            <div  class="d-flex mr-2 align-items-center">
                                <label for="type" class="text-md-right" style="width: 100%; margin-right: 1.25rem;">{{ __('Ordenar por:') }}</label>
                                <select class="form-control" name="type" id="type" style="width: 9.375rem;">
                                    <option value="student">Ascendente</option>
                                    <option value="teacher">Descendente</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="row justify-content-around">
                            
                            @foreach ($inscriptions as $inscription)

                                <div class="card mb-4" style="width: 25rem;
                                @if ($inscription->meeting->state == 'canceled')
                                    background-color: lightgray;
                                @endif
                                ">
                                    <div class="card-body">
                                        <div class="d-flex border-bottom mb-3 justify-content-center align-items-center">
                                            <div class="col justify-content-center">
                                                #{{$inscription->id}}
                                                <img style="height: 10rem;" src="https://www.gammaingenieros.com/wp-content/uploads/2017/07/400x400-300x300.gif" alt="Card image cap">
                                                <div class="d-flex justify-content-around mt-2">
                                                    <button 
                                                        @if ($inscription->meeting->state == 'canceled')
                                                            disabled
                                                        @endif                                                                                                           
                                                    
                                                    href="mailto:{{$inscription->meeting->teacher->email}}" class="btn btn-dark">Email</button>
                                                    
                                                    @if ($inscription->meeting->type == 'virtual')
                                                        <button 
                                                        
                                                        @if ($inscription->meeting->state == 'canceled')
                                                            disabled
                                                        @endif

                                                        href="{{$inscription->meeting->meeting_url}}" class="btn btn-dark">Zoom</button>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <h5 class="font-weight-bold">Profesor</h5>
                                                <p class="card-text">{{$inscription->meeting->teacher->getFullName()}}</p>
                                                <h5 class="font-weight-bold">Cátedra</h5>
                                                <p class="card-text">{{$inscription->meeting->subject->name}}</p>
                                                <h5 class="font-weight-bold">Fecha y hora</h5>

                                                @php
                                                    $date = strtotime($inscription->meeting->datetime);
                                                @endphp
                                                <p class="card-text">{{date('d/m/Y h:i', $date)}}</p>
                                                <h5 class="font-weight-bold">Reunión</h5>
                                                <p class="card-text">{{$inscription->meeting->getType()}} 
                                                    @if ($inscription->meeting->type == 'face-to-face')
                                                    - Aula: {{$inscription->meeting->classroom}}                                                        
                                                    @endif
                                                </p>


                                            </div>
                                        </div>

                                        @if($inscription->meeting->state == 'pending' && $inscription->state == 'enrolled')
                                            <div class="d-flex justify-content-center">
                                                <a href="#" data-toggle="modal" data-target="#deleteModal" data-inscriptionid="{{$inscription->id}}" class="btn btn-dark">Cancelar inscripción</a>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                
                            @endforeach
                            
                        </div>
                    </div>
                </div>
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
        <form action="{{route('inscription.cancel', $user->id)}}" method="POST">
          @csrf
            <div class="modal-body">
                <input type="hidden" value="" id="inscriptionid" name="inscriptionid">
                ¿Estás seguro de cancelar la inscripción a esta consulta?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-danger">Cancelar</button>
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
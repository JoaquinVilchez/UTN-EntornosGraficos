@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
          @include('elements.messages')
            <div class="col-12">
                    <div class="row d-flex align-items-center justify-content-between pb-2">
                        <h1>Próximas consultas</h1>
                        <div>
                            <a href="{{redirect()->back()}}" class="btn btn-primary">Volver</a>
                            <a href="{{route('inscriptions_user.create')}}" class="btn btn-primary">Nueva inscripción</a>
                        </div>
                    </div>

                    <form action="{{route('inscriptions_user.list', $user->id)}}" method="GET">
                        <div class="row align-items-center pb-2 pt-2">
                                <div class="col-auto">
                                    <select class="form-control" name="orderbyDate" id="orderbyDate" style="width: 9.375rem;">
                                        <option value="ASC" {{old('orderbyDate') == "ASC" ? 'selected' : ''}}>Ascendente</option>
                                        <option value="DESC" {{old('orderbyDate') == "DESC" ? 'selected' : ''}}>Descendente</option>
                                    </select>
                                </div>
                                
                                <div class="col-auto">
                                    <button class="btn btn-dark" type="submit">Actualizar</button>
                                </div>
                                    
                        </div>
                    </form>


                    <div class="col">
                        <div class="row justify-content-around">
                            
                            @foreach ($next_inscriptions as $inscription)

                                <div class="card mb-4" style="width: 25rem;
                                @if ($inscription->status == 'canceled')
                                    background-color: lightgray;
                                @endif
                                ">
                                    <div class="card-body">
                                        <div class="d-flex border-bottom mb-3 justify-content-center align-items-center">
                                            <div class="col justify-content-center">
                                                <img style="height: 10rem;" src="https://www.gammaingenieros.com/wp-content/uploads/2017/07/400x400-300x300.gif" alt="Card image cap">
                                                <div class="d-flex justify-content-around mt-2">
                                                    <button 
                                                        @if ($inscription->status == 'canceled')
                                                            disabled
                                                        @endif                                                                                                           
                                                    
                                                    href="mailto:{{$inscription->meeting->teacher->email}}" class="btn btn-dark">Email</button>
                                                    
                                                    @if ($inscription->meeting->type == 'virtual')
                                                        <button 
                                                        
                                                        @if ($inscription->status == 'canceled')
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
                                                    $date = strtotime($inscription->datetime);
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

                                        @if($inscription->meeting->status == 'active' && $inscription->status == 'active')
                                            <div class="d-flex justify-content-center">
                                                <a href="#" data-toggle="modal" data-target="#deleteModal" data-inscriptionid="{{$inscription->id}}" class="btn btn-dark">Cancelar inscripción</a>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                
                            @endforeach

                            @if ($next_inscriptions->first() == false)
                            <p>No se encuentra inscripto a futuras consultas.</p>
                        @endif
                            
                        </div>
                    </div>


                    @if ($previous_inscriptions->first() == true)

                        <div class="row d-flex align-items-center justify-content-between pb-2">
                            <h1>Consultas anteriores</h1>
                        </div>

                        <div class="col pt-2">
                            <div class="row justify-content-around">
                                
                                @foreach ($previous_inscriptions as $inscription)

                                    <div class="card mb-4" style="width: 25rem;
                                    @if ($inscription->status == 'canceled')
                                        background-color: lightgray;
                                    @endif
                                    ">
                                        <div class="card-body">
                                            <div class="d-flex mb-3 justify-content-center align-items-center">
                                                <div class="col justify-content-center">
                                                    <img style="height: 10rem;" src="https://www.gammaingenieros.com/wp-content/uploads/2017/07/400x400-300x300.gif" alt="Card image cap">
                                                    <div class="d-flex justify-content-around mt-2">
                                                        <button 
                                                            @if ($inscription->status == 'canceled')
                                                                disabled
                                                            @endif                                                                                                           
                                                        
                                                        href="mailto:{{$inscription->meeting->teacher->email}}" class="btn btn-dark">Email</button>
                                                        
                                                        @if ($inscription->meeting->type == 'virtual')
                                                            <button 
                                                            
                                                            @if ($inscription->status == 'canceled')
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
                                                        $date = strtotime($inscription->datetime);
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

                                        </div>
                                    </div>
                                    
                                @endforeach

                                <p>No se encontraron consultas realizadas.</p>
                            
                            
                        </div>
                    </div>
                    @endif
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
        <form action="{{route('inscriptions_user.cancel', $user->id)}}" method="POST">
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
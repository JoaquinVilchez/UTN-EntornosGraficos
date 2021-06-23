@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
          @include('elements.messages')
            <div class="col-12">
                    <div class="row d-flex align-items-center justify-content-between border-bottom pb-2">
                        <h1>Mis consultas</h1>
                        <div>
                            <a href="{{route('user.index')}}" class="btn btn-primary">Volver</a>
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
                            <div class="card mb-4" style="width: 25rem;">
                                <div class="card-body">
                                    <div class="d-flex border-bottom mb-3 justify-content-center align-items-center">
                                        <div class="col justify-content-center">
                                            <img style="height: 10rem;" src="https://www.gammaingenieros.com/wp-content/uploads/2017/07/400x400-300x300.gif" alt="Card image cap">
                                            <div class="d-flex justify-content-around mt-2">
                                                <a href="#" class="btn btn-primary">Email</a>
                                                <a href="#" class="btn btn-primary">Zoom</a>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <h5 class="font-weight-bold">Profesor</h5>
                                            <p class="card-text">Juan Carlos</p>
                                            <h5 class="font-weight-bold">Catedra</h5>
                                            <p class="card-text">Analisis Matematico</p>
                                            <h5 class="font-weight-bold">Fecha y hora</h5>
                                            <p class="card-text">Jueves 24 de Agosto a las 19:30hs</p>
                                            <h5 class="font-weight-bold">Reunión</h5>
                                            <p class="card-text">Virtual</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="btn btn-primary">Cancelar consulta</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4" style="width: 25rem;">
                                <div class="card-body">
                                    <div class="d-flex border-bottom mb-3 justify-content-center align-items-center">
                                        <div class="col justify-content-center">
                                            <img style="height: 10rem;" src="https://www.gammaingenieros.com/wp-content/uploads/2017/07/400x400-300x300.gif" alt="Card image cap">
                                            <div class="d-flex justify-content-around mt-2">
                                                <a href="#" class="btn btn-primary">Email</a>
                                                <a href="#" class="btn btn-primary">Zoom</a>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <h5 class="font-weight-bold">Profesor</h5>
                                            <p class="card-text">Juan Carlos</p>
                                            <h5 class="font-weight-bold">Catedra</h5>
                                            <p class="card-text">Analisis Matematico</p>
                                            <h5 class="font-weight-bold">Fecha y hora</h5>
                                            <p class="card-text">Jueves 24 de Agosto a las 19:30hs</p>
                                            <h5 class="font-weight-bold">Reunión</h5>
                                            <p class="card-text">Virtual</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="btn btn-primary">Cancelar consulta</a>
                                    </div>
                                </div>
                            </div>

                        <!-- TODO: BORRAR UNA DE LAS VISTAS-->
                    {{-- <h1>Inscripciones para el alumno {{$user->getFullName()}}</h1>
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
                  </table> --}}

                            <div class="card mb-4" style="width: 25rem;">
                                <div class="card-body">
                                    <div class="d-flex border-bottom mb-3 justify-content-center align-items-center">
                                        <div class="col justify-content-center">
                                            <img style="height: 10rem;" src="https://www.gammaingenieros.com/wp-content/uploads/2017/07/400x400-300x300.gif" alt="Card image cap">
                                            <div class="d-flex justify-content-around mt-2">
                                                <a href="#" class="btn btn-primary">Email</a>
                                                <a href="#" class="btn btn-primary">Zoom</a>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <h5 class="font-weight-bold">Profesor</h5>
                                            <p class="card-text">Juan Carlos</p>
                                            <h5 class="font-weight-bold">Catedra</h5>
                                            <p class="card-text">Analisis Matematico</p>
                                            <h5 class="font-weight-bold">Fecha y hora</h5>
                                            <p class="card-text">Jueves 24 de Agosto a las 19:30hs</p>
                                            <h5 class="font-weight-bold">Reunión</h5>
                                            <p class="card-text">Virtual</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="btn btn-primary">Cancelar consulta</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4" style="width: 25rem; background-color: lightgray;">
                                <div class="card-body">
                                    <div class="d-flex border-bottom mb-3 justify-content-center align-items-center">
                                        <div class="col justify-content-center">
                                            <img style="height: 10rem;" src="https://www.gammaingenieros.com/wp-content/uploads/2017/07/400x400-300x300.gif" alt="Card image cap">
                                            <div class="d-flex justify-content-around mt-2">
                                                <button disabled href="#" class="btn btn-primary">Email</button>
                                                <button disabled href="#" class="btn btn-primary">Zoom</button>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <h5 class="font-weight-bold">Profesor</h5>
                                            <p class="card-text">Juan Carlos</p>
                                            <h5 class="font-weight-bold">Catedra</h5>
                                            <p class="card-text">Analisis Matematico</p>
                                            <h5 class="font-weight-bold">Fecha y hora</h5>
                                            <p class="card-text">Jueves 24 de Agosto a las 19:30hs</p>
                                            <h5 class="font-weight-bold">Reunión</h5>
                                            <p class="card-text">Virtual</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button disabled href="#" class="btn btn-primary">Cancelar consulta</button>
                                    </div>
                                </div>
                            </div>
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
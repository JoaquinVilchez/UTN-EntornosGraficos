@extends('layouts.app')

@section('content')
    <div class="container vh-100">
      <div class="row">
          @include('elements.messages')
            <div class="col-12">
                <div class="container">
                    <div class="row d-flex align-items-center justify-content-between border-bottom pb-2">
                        <h1>Mis consultas</h1>
                        <div>
                            <a href="{{route('user.index')}}" class="btn btn-primary">Volver</a>
                            <a href="{{route('user.index')}}" class="btn btn-primary">Nueva Consulta</a>
                        </div>
                    </div>
                    <div class="row w-100 mb-3">
                        <div class="d-flex mt-3">
                            <div class="mr-2">
                                <input style="width: 12.5rem;" placeholder="Buscar por materia o profesor">
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

@endsection
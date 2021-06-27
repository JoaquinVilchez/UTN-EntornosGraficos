@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row d-flex justify-content-center pb-2">
            <h1>Crear consulta semanal</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('inscriptions.view_meetings')}}">
                    @csrf
                    
                    
    
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Confirmar consulta
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
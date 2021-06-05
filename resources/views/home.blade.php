@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="btn-group-vertical d-flex justify-content-center">
                <a href="{{route('user.home')}}" class="btn btn-primary">Inicio</a>
                <a href="{{route('user.list')}}" class="btn btn-primary">Usuarios</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

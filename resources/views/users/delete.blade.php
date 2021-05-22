@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="DELETE" action="{{ route('user.delete', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        ¿ Está seguro que desea eliminar al usuario {{$user->first_name}} {{$user->last_name}} ?
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Eliminar') }}
                            </button>
                        </div>

                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Cancelar') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
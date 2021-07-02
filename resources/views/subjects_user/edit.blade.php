@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="container d-flex justify-content-center">
            <div class="col-8">
                @include('elements.messages')
                <form method="GET" action="{{ route('subjects_user.view_roles_and_status', $user->id) }}">
                    @csrf

                    <div class="text-center">
                        @if ($user->type == 'teacher')
                            <h2>Materias que brinda el docente <strong>{{$user->getFullName()}}</strong></h2>
                        @elseif($user->type == 'student')
                            <h2>Materias que se encuentra inscripto el alumno <strong>{{$user->getFullName()}}</strong></h2>
                        @endif
                    </div>

                    <hr>
                    @for ($i = 1; $i <= 5; $i++)

                        <div class="card text-center px-5 my-2">
                            <div class="card-body">
                                <h3>Materias de {{$i}}° año</h3>
                                @php
                                $subjects_for_level = get_subjects_for_level($i);
                                @endphp
                                @foreach ($subjects_for_level as $subject)

                                <div class="form-check">
                                    <input type="checkbox" name="subjects[{{$subject->id}}]" class="form-check-input" id="checkbox-id-{{$subject->id}}}"
                                    @if ($user->subjects()->where('subjects.id', $subject->id)->exists())
                                    checked
                                    @endif
                                    >
                                    <label class="form-check-label" for="checkbox-id-{{$subject->id}}}">{{$subject->name}}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endfor
                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary btn-block">
                                Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row d-flex justify-content-center pb-2">
            <h1>Crear consulta semanal</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('meetings.store')}}">
                    @csrf
                    
                    <div class="form-group row">
                        <label for="day" class="col-md-4 col-form-label text-md-right">Día de la semana</label>

                        <div class="col-md-6">
                            <select id="day" class="custom-select @error('day') is-invalid @enderror" name="day" value="{{ old('day') }}" required autocomplete="career">
                                
                            <option value="1">Lunes</option>
                            <option value="2">Martes</option>
                            <option value="3">Miércoles</option>
                            <option value="4">Jueves</option>
                            <option value="5">Viernes</option>
                            <option value="6">Sábado</option>
                            <option value="0">Domingo</option>

                            </select>

                            @error('day')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="hour" class="col-md-4 col-form-label text-md-right">Hora</label>

                        <div class="col-md-6">
                            <input name="hour" id="hour" type="text" class="form-control @error('hour') is-invalid @enderror" value="{{ old('hour') }}" required autocomplete="hour" autofocus>
                            @error('day')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Año de cursado') }}</label>

                        <div class="col-md-6">
                            <input id="level" type="text" class="form-control @error('level') is-invalid @enderror" name="level" value="{{ old('level') }}" required autocomplete="level" autofocus>

                            @error('level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Crear consulta
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js-script')
    <script>
    
        $(document).ready(function(){
            $('#hour').timepicker({
            timeFormat: 'h:mm p',
            interval: 15,
            minTime: '10',
            maxTime: '6:00pm',
            defaultTime: '11',
            startTime: '10:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
            });
        });
        
    </script>
@endsection
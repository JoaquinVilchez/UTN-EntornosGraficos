@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="container d-flex justify-content-center ">
            <div class="col-12 col-md-6">
                <h1 class="text-center">Editar consulta semanal</h1>
                <form method="POST" action="{{ route('meetings.update', $meeting->id)}}">
                    @csrf
                    @method('PUT')
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group row">
                        <div class="col-md-6">

                            <label for="subjects" class="col-form-label">Materia</label>
                            <select id="subjects" onchange="selectTeachers()" data-live-search="true" class="border selectpicker" name="subject" value="{{ old('subject') }}" required>

                                @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}" @if($meeting->subject_id==$subject->id) selected @endif>{{$subject->name}} ({{$subject->career}})</option>
                                @endforeach

                            </select>

                            @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="teachers" class="col-form-label">Profesor</label>
                            <select id="teachers" data-live-search="true" class="border form-control" name="teacher" value="{{ old('teacher') }}" required>
                                <option value="">Seleccione una opción</option>
                            </select>

                            @error('teacher')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="day" class="col-form-label">Día de la semana</label>
                            <select id="day" class="custom-select @error('day') is-invalid @enderror" name="day" value="{{ old('day') }}" required>

                            <option value="1" @if($meeting->day==1) selected @endif>Lunes</option>
                            <option value="2" @if($meeting->day==2) selected @endif>Martes</option>
                            <option value="3" @if($meeting->day==3) selected @endif>Miércoles</option>
                            <option value="4" @if($meeting->day==4) selected @endif>Jueves</option>
                            <option value="5" @if($meeting->day==5) selected @endif>Viernes</option>
                            <option value="6" @if($meeting->day==6) selected @endif>Sábado</option>
                            <option value="0" @if($meeting->day==0) selected @endif>Domingo</option>

                            </select>

                            @error('day')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="hour" class="col-form-label">Hora</label>
                            <input name="hour" id="hour" type="text" class="input-hour form-control @error('hour') is-invalid @enderror" value="{{ old('hour',$meeting->hour) }}" required autocomplete="hour">
                            @error('hour')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="type" class="col-form-label">Tipo</label>
                            <select onchange="disableInputs()" id="type" class="custom-select form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type',$meeting->type) }}" required>
                                <option value="face-to-face">Presencial</option>
                                <option value="virtual">Virtual</option>
                            </select>

                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="classroom" class="col-form-label">Aula</label>
                            <input name="classroom" id="classroom" type="text" class="form-control @error('classroom') is-invalid @enderror" value="{{ old('classroom',$meeting->classroom) }}" required autocomplete="classroom">
                            @error('classroom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="meeting_url" class="col-form-label">Link</label>
                            <input name="meeting_url" id="meeting_url" type="text" class="form-control @error('meeting_url') is-invalid @enderror" value="{{ old('meeting_url',$meeting->meeting_url) }}" required autocomplete="meeting_url">
                            @error('meeting_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 px-0">
                        <button type="submit" class="btn btn-primary btn-block mt-4">
                            Crear consulta
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


@section('js-script')

    <script>
        $( document ).ready(function() {
            disableInputs();
            selectTeachers();
        });

        $(function () {
            $('.selectpicker').selectpicker();
        });

        new Cleave('.input-hour', {
            time: true,
            timePattern: ['h', 'm']
        });

        function selectTeachers(){
            const subjectId = $('#subjects').val();
            const selectTeachers = $("#teachers");
            selectTeachers.find('option').remove();
            let selectOption = `<option value="">Seleccione una opcion</option>`
            selectTeachers.append(selectOption)
            $.ajax({
                url : '/materia/docentes',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data:{subjectId:subjectId},
                success:function(data){
                    let option;
                    meetingTeacher = '{{$meeting->teacher_id}}'
                    const dataArray = Object.values(data);
                    dataArray.forEach(teacher => {
                        if(meetingTeacher==teacher.id){
                            selected = 'selected'
                        }else{
                            selected = null
                        }
                        option = `<option ${selected} value="${teacher.id}">${teacher.first_name} ${teacher.last_name}</option>`;
                        selectTeachers.append(option);
                    });
                },
                error:function(data){
                    console.log(data)
                }
            });
        }

        function disableInputs(){
            let typeValue = $('#type').val();
            console.log(typeValue)
            if($('#type').val()=='virtual'){
                $('#classroom').attr('disabled', 'disabled');
                $('#meeting_url').removeAttr('disabled');
            }else if($('#type').val()=='face-to-face'){
                $('#classroom').removeAttr('disabled');
                $('#meeting_url').attr('disabled', 'disabled');
            }
        }
    </script>
@endsection
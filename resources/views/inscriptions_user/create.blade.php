@extends('layouts.app')

@section('content')
<div class="container vh-100">
  <div class="row">
      <div class="col-12">
        <div class="row d-flex align-items-center justify-content-between border-bottom pb-2">
            <h1>Inscribirse a una consulta</h1>
            <div>
                <a href="{{route('inscriptions_user.list')}}" class="btn btn-primary">Volver</a>
            </div>
        </div>

        <form method="POST" action="{{route('inscriptions_user.create')}}">
        @csrf
          <div class="container mt-5">
            <div class="form-group row">
                <label for="subjects" class="col-md-4 col-form-label text-md-right">{{ __('Materia') }}</label>
              <div class="col-md-6">
                  <select id="subjects" onchange="selectTeacher()" type="text" class="custom-select @error('subjects') is-invalid @enderror" name="subjects" value="{{ old('subjects') }}" required autocomplete="subjects">
                      <option value="">Seleccionar una materia</option>

                    @foreach ($subjects as $subject)
                      <option value="{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach
                  </select>
                  @error('subjects')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="teachers" class="col-md-4 col-form-label text-md-right">{{ __('Docente') }}</label>
              <div class="col-md-6">
                  <select id="teachers" onchange="selectMeeting()" type="text" class="custom-select @error('teachers') is-invalid @enderror" name="teachers" value="{{ old('teachers') }}" required autocomplete="teachers">
                    <option value="">Seleccionar un docente</option>
                  </select>
                  @error('teachers')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>
            </div>

            <div class="form-group row">
                <label for="meetings" class="col-md-4 col-form-label text-md-right">{{ __('Consultas disponibles') }}</label>
                <div class="col-md-6">

                  <div id="meetings" name="meetings">
                  </div>

                    @error('meetings')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary btn-block">
                      Inscribirse
                  </button>
              </div>
          </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js-script')
  <script>
    function selectTeacher(){
      const subjectId = $('#subjects').val();
      const selectTeachers = $("#teachers");
      selectTeachers.find('option').remove();
      $.ajax({
          url : '/inscripciones/nueva/seleccionar-docente',
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          data:{subjectId:subjectId},
          success:function(data){
            let option;
            option = `<option>Seleccione una opción</option>`;
            selectTeachers.append(option);
            data.forEach(teacher => {
              option = `<option value="${teacher.id}">${teacher.first_name} ${teacher.last_name}</option>`;

              selectTeachers.append(option);
            });
          }, 
          error:function(data){
            console.log(data)
          }
      });
    };

    function selectMeeting(){
      const teacherId = $('#teachers').val();
      const subjectId = $('#subjects').val();
      const selectMeetings = $("#meetings");

      selectMeetings.find('option').remove();
      $.ajax({
          url : '/inscripciones/nueva/seleccionar-consulta',
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          data:{teacherId:teacherId, subjectId:subjectId},
          success:function(data){
            $('#meetings').html(data);

            
          }, 
          error:function(data){
            console.log(data)
          }
      });
    }

    $( document ).ready(function() {
        $('.leftmenutrigger').on('click', function(e) {
        $('.side-nav').toggleClass("open");
        e.preventDefault();
    });
    });
  </script>
@endsection
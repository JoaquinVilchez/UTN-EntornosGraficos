@extends('layouts.app')

@section('content')
<div class="container vh-100">
  <div class="row">
      <div class="col-12">
        <div class="row d-flex align-items-center justify-content-between border-bottom pb-2">
            <h1>Crear nueva consulta</h1>
            <div>
                <a href="#" class="btn btn-primary">Cancelar</a>
            </div>
        </div>

        <div class="container mt-5">
          <div class="form-group row">
              <label for="subjects" class="col-md-4 col-form-label text-md-right">{{ __('Materia') }}</label>
            <div class="col-md-6">
                <select id="subjects" onchange="selectTeacher()" type="text" class="custom-select @error('subjects') is-invalid @enderror" name="subjects" value="{{ old('subjects') }}" required autocomplete="subjects">
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
                <select id="teachers" type="text" class="custom-select @error('teachers') is-invalid @enderror" name="teachers" value="{{ old('teachers') }}" required autocomplete="subjects">
                </select>
                @error('teachers')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div>
          </div>
        </div>
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
            data.forEach(teacher => {
              option = `<option value="${teacher.id}">${teacher.first_name} ${teacher.last_name}</option>`;

              selectTeachers.append(option);
            });
          }, 
          error:function(data){
            console.log(data)
          }
      });
    }
  </script>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        
           
            <form action = "{{route('users.search_teacher')}}" method="GET" class="form-inline">
              @csrf 
                <div class="form-group mb-2">
                  <h1 class="form-control-plaintext"> Buscar docente </h1>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                  <label for="buscardor-docente" class="sr-only">Nombre</label>
                  <input type="text" class="form-control" id="buscardor-docente" placeholder="Nombre" name='name'>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Buscar</button>
                     
            
            </form>
          
      
        </div>
    

      <div class="row">
          @include('elements.messages')
            <div class="col-12">
              <div class="d-flex justify-content-between mb-2">
                <h1>Docentes</h1>
              </div>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Legajo</th>
                        <th scope="col">Nombre y apellido</th>
                        <th scope="col">Email</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->university_id}}</td>
                            <td>{{$user->getFullName()}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <a href="{{route('subjects_user.index', $user->id)}}" class = "btn btn-dark">Ver materias</a>
                            </td>
                        </tr>
                    @endforeach
                      <tr>
                    </tbody>
                  </table>
                  {{ $users->links() }}

            </div>
        </div>
      </div>
  
   
        </div>
      </div>
    </div>
@endsection


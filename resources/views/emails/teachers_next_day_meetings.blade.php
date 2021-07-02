@component('mail::message')

¡Hola {{$data['teacher_name']}}! Se informa a continuación la información para las consultas programadas para el día de mañana
@php
    $tomorrow_meetings = $data['meetings'];
@endphp

<h2>Consultas para el día {{get_tomorrow_string()->format('d-m-Y H:i')}}</h2>
@foreach ($tomorrow_meetings as $meeting)

    @php
        $datetime = Carbon::tomorrow()->setTimeFromTimeString($meeting->hour);
        $inscriptions = $meetings->inscriptions->where('datetime', $datetime);
    @endphp

    <div class="row">
        <div class="container d-flex justify-content-center">
            <div class="col-12">
                @include('elements.messages')
                <div class="d-flex justify-content-between align-items-center my-2">
                    <div class="card d-flex justify-content-between mb-2">
                        <h1 class="card-header">Consulta #{{$meeting->id}}}</h1>
                        <div class="card-body">
                        <p class="card-text">
                                Horario: {{$meeting->hour}}<br>
                                Materia: {{$meeting->subject->name}}<br>
                                Año: {{$meeting->subject->level}} <br>
                                Carrera: {{$meeting->subject->career}}<br>
                                Tipo: {{$meeting->getType()}} <br>
                                @if ($meeting->type == 'virtual')
                                    Link: <a href="{{$meeting->meeting_url}}">{{$meeting->meeting_url}}</a>
                                @endif
                                @if ($meeting->type == 'face-to-face')
                                    Aula: {{$meeting->classroom}}                                                                    
                                @endif                            

                        </p>
                        </div>
                    </div>
                    
                </div>
                @if($inscriptions->count() > 0)
                    <table class="table table-sm table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Fecha inscripción</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Legajo</th>
                            <th scope="col">Email</th>
                            <th scope="col">Estado en la materia</th>
                            <th scope="col">Estado de inscripción</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($inscriptions as $inscription)
                                <tr>
                                <td>{{$inscription->datetime}}</td>
                                <td>{{$inscription->student->getFullName()}}</td>
                                <td>{{$inscription->student->university_id}}</td>
                                <td>{{$inscription->student->email}}</td>
                                <td>{{$inscription->student->getStatusofSubjectSpanish($inscription->meeting->subject->id)}}</td>
                                <td>{{$inscription->getState()}}</td>
                                </tr>
                            @endforeach

                            
                        </tbody>
                    </table>
                    @endif
        
            </div>
        </div>
    </div>
@endforeach


Saludos,<br>
{{ config('app.name') }}
@endcomponent
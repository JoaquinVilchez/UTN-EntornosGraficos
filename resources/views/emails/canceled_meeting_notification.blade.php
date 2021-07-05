@component('mail::message')

<p>Hola {{ $data['student_name'] }}. Lamentamos informarte que se ha cancelado una consulta a la cual te encontrabas inscripto, y se ha reprogramado la fecha de la misma.<p>

Docente: {{$data['teacher_name']}} <br>
Motivo de cancelación: {{ $data['reason'] }} <br>
Fecha de reprogramación: {{ $data['alternative_datetime'] }} <br>

<p>En caso de no poder asistir a la fecha propuesta se agradece que se de por cancelada la inscripción.<p>
<p><a href="{{route('inscriptions_user.list')}}">Ver mis consultas</a></p>   

Gracias,<br>
{{ config('app.name') }}
@endcomponent
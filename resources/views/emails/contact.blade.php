@component('mail::message')

Hola Admin se contactaron de la pagina:
Nombre: {{ $data['name'] }}
Mail: {{ $data['email'] }}
Mensaje: {{ $data['message'] }}

Gracias,<br>
{{ config('app.name') }}
@endcomponent
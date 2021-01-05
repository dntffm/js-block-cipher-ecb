
@component('mail::message')
<h1>{{ config('app.name') }} TEAM</h1>

<span># Hello Master,<h4> {{$user->username}}</h4></span>

Kami menerima permintaan untuk mengganti password anda

INI ADALAH KODE TOKEN ANDA:
<h3>{{$user->active_token}}</h3>


Thanks,<br>
{{ config('app.name') }}
@endcomponent

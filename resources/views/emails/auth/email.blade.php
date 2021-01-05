@component('mail::message')
# Introduction

Kofirmasi password baru
p>Hello {{$user->username}}</p>
<p>
	your password: {{$user->password}}
</p>

<!-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent -->

Thanks,<br>
{{ config('app.name') }}
@endcomponent

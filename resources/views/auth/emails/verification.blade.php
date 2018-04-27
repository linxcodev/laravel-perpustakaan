@component('mail::message')
# Verifikasi Email

Klick link Berikut untuk aktivasi

@component('mail::button', ['url' => url('auth/verify', $user->verification_token) .
'?email='. urlencode($user->email)])
Verifikasi
@endcomponent

Salam,<br>
{{ config('app.name') }}
@endcomponent

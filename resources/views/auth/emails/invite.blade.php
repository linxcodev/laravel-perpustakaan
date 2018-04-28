@component('mail::message')
# Halo {{ $member->name }}

Admin kami telah menndaftarkan email anda ({{ $member->email }}) ke Aplikasi
Perpustakaan Online. Untuk login, silahkan kunjingi link berikut:

@component('mail::button', ['url' => url('login')])
Login
@endcomponent

Login dengan email anda anda dan password <strong>{{ $password }}</strong>

Salam,<br>
{{ config('app.name') }}
@endcomponent

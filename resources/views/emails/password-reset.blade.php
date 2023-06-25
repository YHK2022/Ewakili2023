{{-- @component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => 'http://localhost:8000/forget-password?token='.$token])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}
<h1>Forget Password Email</h1>
You can reset password from bellow link:

<a href="{{ url('forget-password', $token) }}">Reset Password</a>
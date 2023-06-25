@component('mail::message')
# Reset Password

Click on the button below to reset your password.

@component('mail::button', ['url' => 'http://localhost:8000/forget-password?token='.$token])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
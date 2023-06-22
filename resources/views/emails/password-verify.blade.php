@component('mail::message')
# Reset Password

Click on the button below to reset your password.

@component('mail::button', ['url' => 'http://localhost:4200/reset-password?token='.$token])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')

Thank you for registering!
Varify your email to click the bellow link and log in your account....
@component('mail::button', ['url' => $url])
Verify Email
@endcomponent


Regards,<br>
{{ config('app.name') }}

Thank you for being a part of UITS!
@endcomponent
